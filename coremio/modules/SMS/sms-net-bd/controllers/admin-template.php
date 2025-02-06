<?php

if (!defined("CORE_FOLDER")) die();

$lang = $module->lang;
$config = $module->config;

$exampleSMS = new ExampleSMS();


// Hook settings
$eventSettings = [

    // Client hooks
    "ClientCreated" => [
        "check" => (string) Filter::init("POST/ClientCreatedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/ClientCreatedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/ClientCreatedNumber", "hclear") ?? "",
    ],

    "ClientInformationModified" => [
        "check" => (string) Filter::init("POST/ClientInformationModifiedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/ClientInformationModifiedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/ClientInformationModifiedNumber", "hclear") ?? "",
    ],

    "PreClientDeleted" => [
        "check" => (string) Filter::init("POST/PreClientDeletedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/PreClientDeletedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/PreClientDeletedNumber", "hclear") ?? "",
    ],

    "ClientDeleted" => [
        "check" => (string) Filter::init("POST/ClientDeletedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/ClientDeletedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/ClientDeletedNumber", "hclear") ?? "",
    ],

    "ClientChangePassword" => [
        "check" => (string) Filter::init("POST/ClientChangePasswordCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/ClientChangePasswordMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/ClientChangePasswordNumber", "hclear") ?? "",
    ],

    "ClientBlocked" => [
        "check" => (string) Filter::init("POST/ClientBlockedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/ClientBlockedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/ClientBlockedNumber", "hclear") ?? "",
    ],

    "ClientActivated" => [
        "check" => (string) Filter::init("POST/ClientActivatedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/ClientActivatedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/ClientActivatedNumber", "hclear") ?? "",
    ],

    "ClientDetailsValidation" => [
        "check" => (string) Filter::init("POST/ClientDetailsValidationCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/ClientDetailsValidationMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/ClientDetailsValidationNumber", "hclear") ?? "",
    ],

    // Order hooks
    "OrderDeleted" => [
        "check" => (string) Filter::init("POST/OrderDeletedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/OrderDeletedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/OrderDeletedNumber", "hclear") ?? "",
    ],

    "OrderApproved" => [
        "check" => (string) Filter::init("POST/OrderApprovedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/OrderApprovedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/OrderApprovedNumber", "hclear") ?? "",
    ],

    "OrderActivated" => [
        "check" => (string) Filter::init("POST/OrderActivatedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/OrderActivatedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/OrderActivatedNumber", "hclear") ?? "",
    ],

    "OrderModified" => [
        "check" => (string) Filter::init("POST/OrderModifiedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/OrderModifiedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/OrderModifiedNumber", "hclear") ?? "",
    ],

    "OrderCancelled" => [
        "check" => (string) Filter::init("POST/OrderCancelledCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/OrderCancelledMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/OrderCancelledNumber", "hclear") ?? "",
    ],

    // Invoice hooks
    "InvoicePaid" => [
        "check" => (string) Filter::init("POST/InvoicePaidCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoicePaidMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoicePaidNumber", "hclear") ?? "",
    ],


    "InvoiceUnpaid" => [
        "check" => (string) Filter::init("POST/InvoiceUnpaidCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoiceUnpaidMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoiceUnpaidNumber", "hclear") ?? "",
    ],

    "InvoiceFormalized" => [
        "check" => (string) Filter::init("POST/InvoiceFormalizedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoiceFormalizedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoiceFormalizedNumber", "hclear") ?? "",
    ],

    "InvoiceCancelled" => [
        "check" => (string) Filter::init("POST/InvoiceCancelledCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoiceCancelledMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoiceCancelledNumber", "hclear") ?? "",
    ],

    "InvoiceRefunded" => [
        "check" => (string) Filter::init("POST/InvoiceRefundedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoiceRefundedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoiceRefundedNumber", "hclear") ?? "",
    ],

    "InvoiceCreated" => [
        "check" => (string) Filter::init("POST/InvoiceCreatedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoiceCreatedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoiceCreatedNumber", "hclear") ?? "",
    ],

    "InvoiceModified" => [
        "check" => (string) Filter::init("POST/InvoiceModifiedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoiceModifiedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoiceModifiedNumber", "hclear") ?? "",
    ],

    "PreInvoiceDeleted" => [
        "check" => (string) Filter::init("POST/PreInvoiceDeletedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/PreInvoiceDeletedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/PreInvoiceDeletedNumber", "hclear") ?? "",
    ],

    "InvoicePaymentReminder" => [
        "check" => (string) Filter::init("POST/InvoicePaymentReminderCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoicePaymentReminderMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoicePaymentReminderNumber", "hclear") ?? "",
    ],

    "InvoiceViewDetails" => [
        "check" => (string) Filter::init("POST/InvoiceViewDetailsCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoiceViewDetailsMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoiceViewDetailsNumber", "hclear") ?? "",
    ],

    "InvoiceDeleted" => [
        "check" => (string) Filter::init("POST/InvoiceDeletedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoiceDeletedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoiceDeletedNumber", "hclear") ?? "",
    ],

    // Ticket hooks

    "TicketAdminUpdated" => [
        "check" => (string) Filter::init("POST/TicketAdminUpdatedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketAdminUpdatedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketAdminUpdatedNumber", "hclear") ?? "",
    ],

    "TicketAdminReplyValidation" => [
        "check" => (string) Filter::init("POST/TicketAdminReplyValidationCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketAdminReplyValidationMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketAdminReplyValidationNumber", "hclear") ?? "",
    ],

    "TicketDeleted" => [
        "check" => (string) Filter::init("POST/TicketDeletedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketDeletedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketDeletedNumber", "hclear") ?? "",
    ],

    "TicketReplyModified" => [
        "check" => (string) Filter::init("POST/TicketReplyModifiedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketReplyModifiedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketReplyModifiedNumber", "hclear") ?? "",
    ],

    "TicketReplyDeleted" => [
        "check" => (string) Filter::init("POST/TicketReplyDeletedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketReplyDeletedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketReplyDeletedNumber", "hclear") ?? "",
    ],

    "TicketSolved" => [
        "check" => (string) Filter::init("POST/TicketSolvedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketSolvedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketSolvedNumber", "hclear") ?? "",
    ],

    "TicketLockChange" => [
        "check" => (string) Filter::init("POST/TicketLockChangeCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketLockChangeMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketLockChangeNumber", "hclear") ?? "",
    ],

    "TicketDepartmentChange" => [
        "check" => (string) Filter::init("POST/TicketDepartmentChangeCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketDepartmentChangeMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketDepartmentChangeNumber", "hclear") ?? "",
    ],

    "TicketPriorityChange" => [
        "check" => (string) Filter::init("POST/TicketPriorityChangeCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketPriorityChangeMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketPriorityChangeNumber", "hclear") ?? "",
    ],

    "TicketStatusChange" => [
        "check" => (string) Filter::init("POST/TicketStatusChangeCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketStatusChangeMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketStatusChangeNumber", "hclear") ?? "",
    ],

    "TicketAssignedChange" => [
        "check" => (string) Filter::init("POST/TicketAssignedChangeCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketAssignedChangeMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketAssignedChangeNumber", "hclear") ?? "",
    ],

    "TicketServiceChange" => [
        "check" => (string) Filter::init("POST/TicketServiceChangeCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketServiceChangeMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketServiceChangeNumber", "hclear") ?? "",
    ],

];

$sets = [];

// Handle event settings dynamically
foreach ($eventSettings as $event => $data) {

    $checkKey = "{$event}Check";
    $messageKey = "{$event}Message";
    $numberKey = "{$event}Number";

    // Ensure proper settings for each event
    $sets[$checkKey] = (!empty($data['check'])) ? 1 : 0;
    $sets[$messageKey] = $data['message'] ?: "";
    $sets[$numberKey] = (!empty($data['number']) && $exampleSMS->validatePhoneNumber($data['number'])) ? $data['number'] : "";
}

// Update configuration if changes exist
if (!empty($sets)) {
    // Merge the updated settings with the existing configuration
    $config_result = array_replace_recursive($config, $sets);
    $array_export = Utility::array_export($config_result, ['pwith' => true]);
    $file = dirname(__DIR__) . DS . "config.php";

    // Write updated settings to file
    $write = FileManager::file_write($file, $array_export);

    if ($write !== false) {
        // Log the change in system
        $adata = UserManager::LoginData("admin");
        User::addAction($adata["id"], "alteration", "changed-sms-module-settings", [
            'module' => $config["meta"]["name"],
            'name' => $lang["name"],
        ]);

        echo Utility::jencode([
            'error' => "0",
            'msg' => $lang["admin-template-success"], // Define success message in language file
        ]);
    } else {
        echo Utility::jencode([
            'error' => "1",
            'msg' => $lang["admin-template-error"], // Define error message in language file
        ]);
    }
} else {
    echo Utility::jencode([
        'error' => "0",
        'msg' => $lang["no-changes"], // Define no changes message in language file
    ]);
}
