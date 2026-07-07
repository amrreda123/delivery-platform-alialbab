<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::with('stores')->withCount('stores')->latest()->get();
    }

    public function createCategory(array $data): Category
    {
        if (isset($data['icon']) && $data['icon'] instanceof \Illuminate\Http\UploadedFile && $data['icon']->isValid()) {
            $fileName = $data['icon']->hashName();
            Storage::disk('public')->put('categories/' . $fileName, file_get_contents($data['icon']->getPathname()));
            $data['icon'] = 'categories/' . $fileName;
        } else {
            unset($data['icon']);
        }

        $data['is_active'] = filter_var($data['is_active'] ?? false, FILTER_VALIDATE_BOOLEAN);

        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): bool
    {
        if (isset($data['icon']) && $data['icon'] instanceof \Illuminate\Http\UploadedFile && $data['icon']->isValid()) {
            if ($category->icon) {
                Storage::disk('public')->delete($category->icon);
            }
            $fileName = $data['icon']->hashName();
            Storage::disk('public')->put('categories/' . $fileName, file_get_contents($data['icon']->getPathname()));
            $data['icon'] = 'categories/' . $fileName;
        } else {
            unset($data['icon']);
        }

        $data['is_active'] = filter_var($data['is_active'] ?? false, FILTER_VALIDATE_BOOLEAN);

        return $category->update($data);
    }

    public function deleteCategory(Category $category): bool|null
    {
        if ($category->icon) {
            Storage::disk('public')->delete($category->icon);
        }

        return $category->delete();
    }
}
