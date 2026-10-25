<?php

// Add a deposit to the customer's opening balance.
function calculateDeposit($openingBalance, $amount) {
    return $openingBalance + $amount;
}

// Subtract a withdrawal from the customer's opening balance.
function calculateWithdrawal($openingBalance, $amount) {
    return $openingBalance - $amount;
}

// Apply the fee rules for deposits and withdrawals.
function calculateTransactionFee($transactionType, $amount) {
    if ($transactionType == "Deposit") {
        return 0;
    } elseif ($transactionType == "Withdrawal" && $amount < 500) {
        return 2;
    } elseif ($transactionType == "Withdrawal" && $amount >= 500) {
        return 5;
    } else {
        return 0;
    }
}

// Calculate simple interest for the selected account and number of years.
function calculateInterest($accountType, $finalBalance, $duration) {
    if ($accountType == "Savings") {
        $rate = 0.03;
    } elseif ($accountType == "Current") {
        $rate = 0.05;
    } elseif ($accountType == "Business") {
        $rate = 0.02;
    } else {
        $rate = 0;
    }

    return $finalBalance * $rate * $duration;
}

// In this simulation, the transaction fee is the only banking charge.
function calculateTotalCharges($transactionFee) {
    return $transactionFee;
}

// Return the balance after applying the transaction and its charges.
function calculateFinalBalance($openingBalance, $transactionType, $amount, $totalCharges) {
    if ($transactionType == "Deposit") {
        return $openingBalance + $amount - $totalCharges;
    } else {
        return $openingBalance - $amount - $totalCharges;
    }
}

// Assign a balance category to the final account balance.
function checkAccountStatus($finalBalance) {
    if ($finalBalance >= 5000) {
        return "High Balance";
    } elseif ($finalBalance >= 1000) {
        return "Medium Balance";
    } else {
        return "Low Balance";
    }
}

// Project the balance using annual interest; one year is used when omitted.
function calculateFutureBalance($finalBalance, $annualInterest, $years = 1) {
    return $finalBalance + ($annualInterest * $years);
}
?>
