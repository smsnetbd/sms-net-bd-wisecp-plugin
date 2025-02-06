<?php 

return $hooks_array = [

    // Client hooks
    "ClientCreated" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {name}",
        "message" => "Client {name} created",
        "number" => "",
    ],

    "ClientInformationModified" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {name}",
        "message" => "Client {name} Information Modified",
        "number" => "",
    ],

    "PreClientDeleted" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {name}",
        "message" => "Pre Client {name} Deleted",
        "number" => "",
    ],

    "ClientDeleted" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {name}",
        "message" => "Client {name} Deleted",
        "number" => "",
    ],

    "ClientChangePassword" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {name}",
        "message" => "Client {name} Change Password",
        "number" => "",
    ],

    "ClientBlocked" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {name}",
        "message" => "Client {name} Blocked",
        "number" => "",
    ],

    "ClientActivated" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {name}",
        "message" => "Client {name} Activated",
        "number" => "",
    ],

    "ClientDetailsValidation" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {name}",
        "message" => "Client {name} Details Validation",
        "number" => "",
    ],

    // Order hooks
    "OrderDeleted" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Order #{id} Deleted",
        "number" => "",
    ],

    "OrderApproved" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Order #{id} Approved",
        "number" => "",
    ],

    "OrderActivated"=> [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Order #{id} Activated",
        "number" => "",
    ],

    "OrderModified" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Order #{id} Modified",
        "number" => "",
    ],

    "OrderCancelled" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Order #{id} Cancelled",
        "number" => "",
    ],

    // Invoice hooks
    "InvoicePaid" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Paid",
        "number" => "",
        ],

    
        "InvoiceUnpaid" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Unpaid",
        "number" => "",
    ],
    
    "InvoiceFormalized" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Formalized",
        "number" => "",
    ],

    "InvoiceCancelled" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Cancelled",
        "number" => "",
    ],

    "InvoiceRefunded" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Refunded",
        "number" => "",
    ],

    "InvoiceCreated" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Created",
        "number" => "",
    ], 

    "InvoiceModified" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Modified",
        "number" => "",
    ],

    "PreInvoiceDeleted" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Deleted",
        "number" => "",
    ],

    "InvoicePaymentReminder" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Payment Reminder",
        "number" => "",
    ],

    "InvoiceViewDetails" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} View Details",
        "number" => "",
    ],

    "InvoiceDeleted" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Deleted",
        "number" => "",
    ],

    // Ticket hooks
    "TicketAdminUpdated" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Admin Updated",
        "number" => "",
    ],

    "TicketAdminReplyValidation" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Admin Reply Validation",
        "number" => "",
    ],

    "TicketDeleted" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Deleted",
        "number" => "",
    ],

    "TicketReplyModified" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Reply Modified",
        "number" => "",
    ],

    "TicketReplyDeleted" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Reply Deleted",
        "number" => "",
    ],

    "TicketSolved" => [ 
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Solved",
        "number" => "",
       ],

   
       "TicketLockChange"=>[
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Lock Changed",
        "number" => "",
    ],

    "TicketDepartmentChange" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Department Changed",
        "number" => "",
    ],

    "TicketPriorityChange" => [ 
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Priority Changed",
        "number" => "",
    ],

    "TicketStatusChange" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Status Changed",
        "number" => "",
    ],

    "TicketAssignedChange" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Assigned",
        "number" => "",
    ],

    "TicketServiceChange" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Service Changed",
        "number" => "",
    ],

];

