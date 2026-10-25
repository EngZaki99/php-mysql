<?php
require_once "functions.php";


if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "<h2>Please submit the banking form first.</h2>";
    echo '<p><a href="index.html">Back to Banking Form</a></p>';
    exit;
}


$customerName = isset($_POST["customer_name"]) ? $_POST["customer_name"] : "";
$accountNumber = isset($_POST["account_number"]) ? $_POST["account_number"] : "";
$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
$accountType = isset($_POST["account_type"]) ? $_POST["account_type"] : "";
$openingBalance = isset($_POST["opening_balance"]) ? $_POST["opening_balance"] : "";
$transactionType = isset($_POST["transaction_type"]) ? $_POST["transaction_type"] : "";
$transactionAmount = isset($_POST["transaction_amount"]) ? $_POST["transaction_amount"] : "";
$duration = isset($_POST["duration"]) ? $_POST["duration"] : "";

$errors = "";

if (empty($customerName)) {
    $errors .= "<li>Customer full name is required.</li>";
}
if (empty($accountNumber)) {
    $errors .= "<li>Account number is required.</li>";
}
if ($gender != "Male" && $gender != "Female") {
    $errors .= "<li>Please select a gender.</li>";
}
if ($accountType != "Savings" && $accountType != "Current" && $accountType != "Business") {
    $errors .= "<li>Please select an account type.</li>";
}
if ($openingBalance === "" || $openingBalance < 0) {
    $errors .= "<li>Opening balance must be zero or greater.</li>";
}
if ($transactionType != "Deposit" && $transactionType != "Withdrawal") {
    $errors .= "<li>Please select a transaction type.</li>";
}
if ($transactionAmount === "" || $transactionAmount <= 0) {
    $errors .= "<li>Transaction amount must be greater than zero.</li>";
}
if ($duration === "" || $duration < 0 || $duration % 1 != 0) {
    $errors .= "<li>Account duration must be a non-negative whole number.</li>";
}


$transactionFee = 0;
if (($transactionType == "Deposit" || $transactionType == "Withdrawal") &&
    $transactionAmount !== "" && $transactionAmount > 0) {
    $transactionFee = calculateTransactionFee($transactionType, $transactionAmount);
    if ($transactionType == "Withdrawal" && $openingBalance !== "" &&
        ($transactionAmount + $transactionFee) > $openingBalance) {
        $errors .= "<li>Withdrawal amount plus transaction fee cannot exceed the opening balance.</li>";
    }
}


$fileSelected = isset($_FILES["id_document"]) && $_FILES["id_document"]["error"] == 0;
if (!$fileSelected) {
    $errors .= "<li>Please select an identification document.</li>";
}

if ($fileSelected) {
    $fileName = $_FILES["id_document"]["name"];
    $fileSize = $_FILES["id_document"]["size"];
    $fileType = $_FILES["id_document"]["type"];
    $temporaryName = $_FILES["id_document"]["tmp_name"];

    if ($fileSize > 2097152) {
        $errors .= "<li>The document must not be larger than 2 MB.</li>";
    }

   
    $targetPath = "uploads/" . $fileName;
    if (file_exists($targetPath)) {
        $errors .= "<li>A file with this name already exists. Rename your file and try again.</li>";
    }
}

if (!empty($errors)) {
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Validation Errors</title>';
    echo '<style>body{font-family:Arial;background:#f1f5f9;padding:30px}.box{max-width:700px;margin:auto;background:white;padding:25px;border-radius:12px}h1{color:#b91c1c}a{color:#1769aa}</style>';
    echo '</head><body><div class="box"><h1>Please correct these errors</h1><ul>' . $errors . '</ul>';
    echo '<a href="index.html">Back to Banking Form</a></div></body></html>';
    exit;
}


if (!move_uploaded_file($temporaryName, $targetPath)) {
    echo "<h2>Error: The identification document could not be uploaded.</h2>";
    echo '<a href="index.html">Back to Banking Form</a>';
    exit;
}

$transactionFee = calculateTransactionFee($transactionType, $transactionAmount);
$totalCharges = calculateTotalCharges($transactionFee);
$finalBalance = calculateFinalBalance($openingBalance, $transactionType, $transactionAmount, $totalCharges);

if ($accountType == "Savings") {
    $interestRate = "3%";
} elseif ($accountType == "Current") {
    $interestRate = "5%";
} else {
    $interestRate = "2%";
}

$interest = calculateInterest($accountType, $finalBalance, $duration);
$accountStatus = checkAccountStatus($finalBalance);
$annualInterest = calculateInterest($accountType, $finalBalance, 1);
$futureBalance = calculateFutureBalance($finalBalance, $annualInterest, $duration);

// Format and display the receipt.
function receiptRow($label, $value) {
    echo "<tr><th>" . $label . "</th><td>" . $value . "</td></tr>";
}

echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Banking Transaction Receipt</title>';
echo '<style>body{font-family:Arial,sans-serif;background:#f1f5f9;padding:25px;color:#1e293b}.receipt{max-width:800px;margin:auto;background:white;padding:28px;border-radius:12px;box-shadow:0 8px 25px #00000012}h1{text-align:center;color:#123b68}p.note{text-align:center;color:#64748b}table{width:100%;border-collapse:collapse;margin-top:22px}th,td{padding:12px;border:1px solid #dbe3ec;text-align:left}th{background:#edf4fb;width:45%}tr:nth-child(even) td{background:#fafcff}.back{display:inline-block;margin-top:20px;background:#1769aa;color:white;padding:11px 16px;border-radius:7px;text-decoration:none}</style>';
echo '</head><body><main class="receipt"><h1>Banking Transaction Receipt</h1><p class="note">Fictional transaction simulation — not a real bank transaction</p><table>';

receiptRow("Customer Full Name", $customerName);
receiptRow("Account Number", $accountNumber);
receiptRow("Gender", $gender);
receiptRow("Account Type", $accountType);
receiptRow("Opening Balance", "$" . number_format($openingBalance, 2));
receiptRow("Transaction Type", $transactionType);
receiptRow("Transaction Amount", "$" . number_format($transactionAmount, 2));
receiptRow("Transaction Fee", "$" . number_format($transactionFee, 2));
receiptRow("Total Banking Charges", "$" . number_format($totalCharges, 2));
receiptRow("Final Balance", "$" . number_format($finalBalance, 2));
receiptRow("Account Status", $accountStatus);
receiptRow("Account Duration", $duration . " year(s)");
receiptRow("Interest Rate", $interestRate);
receiptRow("Calculated Interest", "$" . number_format($interest, 2));
receiptRow("Projected Future Balance", "$" . number_format($futureBalance, 2));
receiptRow("Document Name", $fileName);
receiptRow("File Type", $fileType);
receiptRow("File Size", $fileSize . " bytes");
receiptRow("Upload Status", "Successful");

echo '</table><a class="back" href="index.html">Back to Banking Form</a></main></body></html>';
?>
