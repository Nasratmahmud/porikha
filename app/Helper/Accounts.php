<?php

namespace App\Helper;




use App\Models\Transaction;

class Accounts
{
    public static function debitBalance($account_id)
    {
        return Transaction::where('account_id', $account_id)
            ->where('type', 1)
            ->sum('amount');
    }


    public static function creditBalance($account_id)
    {
        return Transaction::where('account_id', $account_id)
            ->where('type', 2)
            ->sum('amount');
    }

    public static function postBalance($account_id)
    {
        $credit = self::creditBalance($account_id);
        $debit = self::debitBalance($account_id);
        return ($credit - $debit);
    }

    public static function previousDebitBalance($account_id, $date)
    {
        return Transaction::where('account_id', $account_id)
            ->where('type', 1)
            ->where('created_at', '<', $date)
            ->sum('amount');


    }

    public static function previousCreditBalance($account_id, $date)
    {
        return Transaction::where('account_id', $account_id)
            ->where('type', 2)
            ->where('created_at', '<', $date)
            ->sum('amount');

    }

    public static function previousPostBalance($account_id, $date)
    {
        $credit = self::previousCreditBalance($account_id, $date);
        $debit = self::previousDebitBalance($account_id, $date);

        return ($credit - $debit);
    }
}
