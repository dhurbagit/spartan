<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    protected $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function index()
    {
        return view('backend.menu.index');
    }

    public function create()
    {
        $menu_categories = Menu::contentType;
        $parent_menus = Menu::where('parent_id', null)->get();
        return view('backend.menu.form', compact('menu_categories', 'parent_menus'));
    }

    public function store(MenuRequest $request)
    {
        try {
            $parent_id = $request->main_child ? $request->parent_id : null;

            // collect uploaded file paths here
            $validated = [];

            $fileMap = [
                'bannerImage' => 'bannerImage',
                'image' => 'image',
            ];

            foreach ($fileMap as $input => $column) {
                if ($file = $request->file($input)) {
                    $validated[$column] = $file->store(class_basename(Menu::class), 'public');
                }
            }

            $new_menu = Menu::create([
                'menu_name' => $request->menu_name,
                'page_title' => $request->page_title,
                'position' => Menu::count() + 1,
                'category_slug' => $request->category_slug,
                'main_child' => $request->main_child,
                'parent_id' => $parent_id,
                'external_link' => $request->external_link,
                'header_footer' => $request->header_footer,
                'title_slug' => Str::slug($request->page_title . '-' . Str::random(5)),
                'content' => $request->content,
                'description' => $request->description,
                'metaTitle' => $request->metaTitle,
                'metaKeyword' => $request->metaKeyword,
                'metaDescription' => $request->metaDescription,
                // inject stored paths (if any)
                'bannerImage' => $validated['bannerImage'] ?? null,
                'image' => $validated['image'] ?? null,
            ]);

            return $new_menu
                ? redirect()->route('menu.index')->with('message', 'Menu information is saved successfully.')
                : redirect()->route('menu.index')->with('error', 'Something went wrong.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('menu.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $parent_menus = Menu::where('parent_id', null)->get();
        $menu_categories = Menu::contentType;
        $data = Menu::findOrFail($id);
        return view('backend.menu.form', compact('data', 'menu_categories', 'parent_menus'));
    }

    public function update(MenuRequest $request, string $id)
    {
        try {
            $menu = Menu::findOrFail($id);

            $parent_id = null;

            if ($request->input('main_child') == 1) {
                $parent_id = $request->input('parent_id');
            }
            $fileMap = [
                'bannerImage' => 'bannerImage',
                'image' => 'image',
            ];

            foreach ($fileMap as $input => $column) {
                if ($file = $request->file($input)) {
                    if (!empty($menu->{$column}) && Storage::disk('public')->exists($menu->{$column})) {
                        Storage::disk('public')->delete($menu->{$column});
                    }
                    $menu->{$column} = $file->store(class_basename(Menu::class), 'public');
                }
            }

            $menu->update([
                'menu_name' => $request->menu_name,
                'page_title' => $request->page_title,
                'position' => Menu::count() + 1,
                'category_slug' => $request->category_slug,
                'main_child' => $request->main_child,
                'parent_id' => $parent_id,
                'external_link' => $request->external_link,
                'header_footer' => $request->header_footer,
                'content' => $request->content,
                'description' => $request->description,
                'metaTitle' => $request->metaTitle,
                'metaKeyword' => $request->metaKeyword,
                'metaDescription' => $request->metaDescription,
            ]);

            return redirect()->route('menu.index')->with('message', 'Menu information updated successfully.');
        } catch (\Exception $e) {
            // Return with an error message, including the exception message
            return redirect()->route('menu.index')->with('error', 'An error occurred while updating the menu: ' . $e->getMessage());
        }
    }

    // drag and drop menu update button code.

    public function updateMenuOrder(Request $request)
    {
        $order = 1;

        // Decode JSON string to array if necessary
        $menuItems = is_array($request->sort) ? $request->sort : json_decode($request->sort, true);

        if (isset($menuItems)) {
            $this->updateMenuItems($menuItems, null, $order);
        }

        return response()->json(['success' => true]);
    }

    // above update button code function
    private function updateMenuItems(array $items, $parentId = null, &$order)
    {
        foreach ($items as $item) {
            $this
                ->menu
                ->where('id', $item['id'])
                ->update([
                    'position' => $order,
                    'parent_id' => $parentId,
                    'main_child' => $parentId ? 1 : 0,
                ]);

            $order++;

            // If the item has children, recursively update them
            if (isset($item['children']) && is_array($item['children'])) {
                $this->updateMenuItems($item['children'], $item['id'], $order);
            }
        }
    }

    public function destroy(string $id)
    {
        $deleteMenu = Menu::findOrFail($id);

        if ($deleteMenu) {
            $children = $deleteMenu->children()->get();

            // If the menu item has a parent, get its parent_id
            $parentId = $deleteMenu->parent_id;

            foreach ($children as $child) {
                // Update each child's parent_id with the parent's parent_id
                $child->parent_id = $parentId;
                $child->save();
            }
        }


        if (!empty($deleteMenu->image) && Storage::disk('public')->exists($deleteMenu->image)) {
            Storage::disk('public')->delete($deleteMenu->image);
        }

        if (!empty($deleteMenu->bannerImage) && Storage::disk('public')->exists($deleteMenu->bannerImage)) {
            Storage::disk('public')->delete($deleteMenu->bannerImage);
        }

        $deleteMenu->delete();
        return redirect()->back()->with('message', 'Deleted successfully!');
    }

    public function status(Request $request)
    {
        $update = Menu::findOrFail($request->id);
        if ($update) {
            $update->status = $update->status ? 0 : 1;

            $update->save();
            return 'Status Updated!';
        } else {
            return 'Not found!';
        }
    }
}
