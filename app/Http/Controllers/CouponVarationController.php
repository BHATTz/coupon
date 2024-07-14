<?php

namespace App\Http\Controllers;

use App\Models\CouponVarations;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CouponsVarationsImport;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Product;

class CouponVarationController extends Controller
{
    //
    // public function import()
    // {
    //     Excel::import(new CouponsVarationsImport, request()->file('your_file'));
    //     return redirect('/')->with('success', 'All good!');
    // }


    public function index($id)
    {
        $couponId = $id;
        return view('admin.coupon.couponVarationImport', compact('couponId'));
    }

    public function import(Request $request, $id)
    {

        $coupon = Coupon::find($id);
        $couponid = $coupon->id;
        $parentsku = $coupon->sku;
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $line) {
            $data = str_getcsv($line);

            // skip the first row of the csv
            CouponVarations::create([
                'coupon_id' => $couponid,
                // 'sku_id' => $parentsku,
                'coupon_code' => $data[0],
                'varation_sku' => $data[1],
            ]);
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }


    public function export($id)
    {

        $products = CouponVarations::findOrFail($id);
        if (empty($products)) {
            return redirect()->back()->with('error', 'No varation found for this coupon!');
        }
        $csvFileName = 'product.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['coupon_id', 'coupon_code', 'varation_sku']); // Add more headers as needed

        foreach ($products as $product) {
            fputcsv($handle, [$product->coupon_id, $product->coupon_code, $product->varation_sku]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }
}
