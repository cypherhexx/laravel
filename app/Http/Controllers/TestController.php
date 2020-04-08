<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tests;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;

class TestController extends Controller
{
    public function login()
    {
        $books = Tests::all();
        $books = json_encode($books);
     
        // return 'view('welcome.blade.php',compact('Tests'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);'
        $mid = '123123456';
        $store_name = 'YOURMART';
        $store_address = 'Mart Address';
        $store_phone = '1234567890';
        $store_email = 'yourmart@email.com';
        $store_website = 'yourmart.com';
        $tax_percentage = 10;
        $transaction_id = 'TX123ABC456';
        var_dump($transaction_id);
        exit(0);

        // // Set items
        // $items = [
        //     [
        //         'name' => 'French Fries (tera)',
        //         'qty' => 2,
        //         'price' => 65000,
        //     ],
        //     [
        //         'name' => 'Roasted Milk Tea (large)',
        //         'qty' => 1,
        //         'price' => 24000,
        //     ],
        //     [
        //         'name' => 'Honey Lime (large)',
        //         'qty' => 3,
        //         'price' => 10000,
        //     ],
        //     [
        //         'name' => 'Jasmine Tea (grande)',
        //         'qty' => 3,
        //         'price' => 8000,
        //     ],
        // ];

        // // Init printer
        // $printer = new ReceiptPrinter;
        // $printer->init(
        //     config('receiptprinter.connector_type'),
        //     config('receiptprinter.connector_descriptor')
        // );

        // // Set store info
        // $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);

        // // Add items
        // foreach ($items as $item) {
        //     $printer->addItem(
        //         $item['name'],
        //         $item['qty'],
        //         $item['price']
        //     );
        // }
        // // Set tax
        // $printer->setTax($tax_percentage);

        // // Calculate total
        // $printer->calculateSubTotal();
        // $printer->calculateGrandTotal();

        // // Set transaction ID
        // $printer->setTransactionID($transaction_id);

        // // Set qr code
        // $printer->setQRcode([
        //     'tid' => $transaction_id,
        // ]);

        // // Print receipt
        // $printer->printReceipt();
        return $books;
    }

    public function insert()
    {
     

    }

    public function index()
    {
        $books = Tests::all();
        $books = json_encode($books);
        $books = json_encode($books);
     
        // return 'view('welcome.blade.php',compact('Tests'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);'
        $mid = '123123456';
        $store_name = 'YOURMART';
        $store_address = 'Mart Address';
        $store_phone = '1234567890';
        $store_email = 'yourmart@email.com';
        $store_website = 'yourmart.com';
        $tax_percentage = 10;
        $transaction_id = 'TX123ABC456';
        //var_dump($transaction_id);
        
        error_log($transaction_id);
        // Set items
        $items = [
            [
                'name' => 'French Fries (tera)',
                'qty' => 2,
                'price' => 65000,
            ],
            [
                'name' => 'Roasted Milk Tea (large)',
                'qty' => 1,
                'price' => 24000,
            ],
            [
                'name' => 'Honey Lime (large)',
                'qty' => 3,
                'price' => 10000,
            ],
            [
                'name' => 'Jasmine Tea (grande)',
                'qty' => 3,
                'price' => 8000,
            ],
        ];

        // Init printer
        $printer = new ReceiptPrinter;
        $printer->init(
            config('receiptprinter.connector_type'),
            config('receiptprinter.connector_descriptor')
        );
        $printer->setX();

       // Set store info
        $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);

        // Add items
        foreach ($items as $item) {
            $printer->addItem(
                $item['name'],
                $item['qty'],
                $item['price']
            );
        }
        // Set tax
        $printer->setTax($tax_percentage);

        // Calculate total
        $printer->calculateSubTotal();
        $printer->calculateGrandTotal();

        // Set transaction ID
        $printer->setTransactionID($transaction_id);

        // Set qr code
        $printer->setQRcode([
            'tid' => $transaction_id,
        ]);

        // Print receipt
        $printer->printReceipt();
            
        // return 'view('welcome.blade.php',compact('Tests'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);'
        return $books;
       // return ['ss'=> 'ss'];
    }

  
    public function show($id)
    {
        return Task::find($id);
    }

    public function store(Request $request)
    {
        return Task::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());

        return $task;
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return 204;
    }
}
