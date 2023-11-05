<?php

namespace App\Http\Controllers\Dashboard\Payment;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Table\Payment\TransactionsTable;
use Illuminate\Http\Request;
use DataTables;

class TransactionsController extends Controller
{
    public  function index(TransactionsTable $dataTable)
    {
        return $dataTable->render();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Transaction::findOrfail($id)->delete();
    }
}
