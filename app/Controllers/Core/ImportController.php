<?php

namespace App\Controllers\Core;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\AttributeModel;
use App\Models\AttributeValueModel;
use App\Models\ProductImageModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportController extends BaseController
{
    public function index()
    {
        return view('upload_product_data/view.php');
    }

    public function upload()
    {
        $file = $this->request->getFile('file');

        if ($file->isValid()) {
            // Rename the file
            $newFileName = $file->getClientName() . '_date_' . date('M_D_Y');
            $newFilePath = WRITEPATH . 'uploads/' . $newFileName;
            $file->move(WRITEPATH . 'uploads', $newFileName);

            $extension = $file->getClientExtension();
            if ($extension == 'csv') {
                // Parse the CSV file
                $csvData = array_map('str_getcsv', file($newFilePath));
                // Validate and insert data
                $this->importCSVData($csvData);
            } elseif (in_array($extension, ['xls', 'xlsx'])) {
                // Parse the Excel file
                $spreadsheet = IOFactory::load($newFilePath);
                $sheet = $spreadsheet->getActiveSheet();
                $excelData = $sheet->toArray();
                // Validate and insert data
                $this->importCSVData($excelData);
            } else {
                return redirect()->back()->with('error', 'Invalid file type.');
            }

            return redirect()->to('/import')->with('success', 'Data imported successfully.');
        }

        return redirect()->back()->with('error', 'File upload failed.');
    }

    private function importCSVData(array $csvData)
    {
        // Assuming the first row contains column headers
        $header = array_shift($csvData);

        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $attributeModel = new AttributeModel();
        $attributeValueModel = new AttributeValueModel();
        $productImageModel = new ProductImageModel();

        foreach ($csvData as $row) {
            // Map CSV row to associative array
            $data = array_combine($header, $row);

            // Validate and process data here
            // For example, find or create category
            $category = $categoryModel->where('name', $data['category'])->first();
            if (!$category) {
                $categoryModel->save(['name' => $data['category']]);
                $categoryId = $categoryModel->getInsertID();
            } else {
                $categoryId = $category['id'];
            }

            // Insert product data
            $productModel->save([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'category_id' => $categoryId,
            ]);

            $productId = $productModel->getInsertID();

            // Insert attributes
            if (!empty($data['attributes'])) {
                $attributes = explode(',', $data['attributes']);
                foreach ($attributes as $attribute) {
                    // Split attribute into name and value
                    list($attrName, $attrValue) = explode(':', trim($attribute));

                    // Find or create attribute
                    $attr = $attributeModel->where('name', trim($attrName))->first();
                    if (!$attr) {
                        $attributeModel->save(['name' => trim($attrName)]);
                        $attributeId = $attributeModel->getInsertID();
                    } else {
                        $attributeId = $attr['id'];
                    }

                    // Insert attribute value
                    $attributeValueModel->save([
                        'attribute_id' => $attributeId,
                        'value' => trim($attrValue),
                        'product_id' => $productId
                    ]);
                }
            }

            // Insert images
            if (!empty($data['images'])) {
                $images = explode(',', $data['images']);
                foreach ($images as $imagePath) {
                    $productImageModel->save([
                        'product_id' => $productId,
                        'image_path' => trim($imagePath),
                        'is_primary' => false
                    ]);
                }
            }
        }
    }
}
