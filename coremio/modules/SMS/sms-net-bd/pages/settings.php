<?php
if (!defined("CORE_FOLDER")) die();

$LANG       = $module->lang;
$CONFIG     = $module->config;
$exampleSMS = new ExampleSMS();

// hooks array file include
$hooks_array = include dirname(__DIR__) . DS . "controllers" . DS . "hooks-array.php";

User::addAction()
?>

<style>
    .tab-header {
        display: flex;
        flex-wrap: wrap;
        /* Enable wrapping for responsiveness */
        background: #007BFF;
    }

    .tab-link {
        flex: 1 1 auto;
        /* Allow flexibility */
        padding: 10px;
        text-align: center;
        color: #fff;
        cursor: pointer;
        background: #0056b3;
        border: none;
        transition: background 0.3s;
    }

    .tab-link.active {
        background: #003d80;
        font-weight: bold;
    }

    .tab-content {
        display: none;
        padding: 20px;
        background-color: #f9f9f9;
        animation: fadeIn 0.3s ease-in-out;
    }

    .tabcontent.active {
        display: block;
    }

    .yuzde30 {
        width: 25%;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .formcon {
        float: none;
        padding-top: 16px;
        padding-bottom: 28px;
    }

    .formcon .yuzde30 {
        flex: 1 1 30%;
        font-weight: bold;
        padding-right: 10px;
    }

    .formcon .yuzde70 {
        flex: 1 1 70%;
    }

    .sms_net_bd {
        display: inline-flex;
        align-items: center;
    }

    .sms_net_bd input[type="checkbox"] {
        height: 16px;
        width: auto;
        width: 16px;
    }

    .sms_net_bd span {
        font-weight: normal !important;
    }

    .guncellebtn {
        text-align: center;
    }

    .yesilbtn {
        background-color: #28a745;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .yesilbtn:hover {
        background-color: #218838;
    }

    .yuzde30 {
        width: 25%;
    }

    .sms_net_bd_input span {
        font-weight: normal;
    }

    /* media query */
    @media (max-width: 1024px) {
        .sms_net_bd_input {
            justify-content: start;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .tab-link {
            flex: 1 1 100%;
            /* Tabs take full width on smaller screens */
        }



        .yesilbtn {
            width: 100%;
        }

        .admin-template {
            min-height: 250px;
            padding: 10px;
        }

        .sms_net_bd_input {
            justify-content: start;
        }
    }

    .verticaltabstitle {
        padding-bottom: 10px;
    }

    .verticaltabstitle img {
        bottom: 10px;
    }
</style>




<div class="verticaltabs" id="verticaltabs">
    <div id="tab-module">
        <!-- Tab navigation -->
        <ul class="tab">
            <li>
                <a data-tab="settings" class="tablinks active">
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <a data-tab="admin-template" class="tablinks">
                    <span>Admin Template</span>
                </a>
            </li>
            <li>
                <a data-tab="send-sms" class="tablinks">
                    <span>Send SMS</span>
                </a>
            </li>
        </ul>

        <!-- Billing Profile Content -->
        <div id="settings" class="tabcontent active">
            <div class="verticaltabstitle">
                <h2>Settings</h2>
            </div>
            <form action="<?php echo Controllers::$init->getData("links")["controller"]; ?>" method="post" id="ExampleSMSSettings">
                <input type="hidden" name="operation" value="module_controller">
                <input type="hidden" name="module" value="ExampleSMS">
                <input type="hidden" name="controller" value="settings">

                <div class="formcon">
                    <div class="yuzde30">Api Token</div>
                    <div class="yuzde70">
                        <input type="text" name="api-token" value="<?php echo $CONFIG["api-token"]; ?>">
                        <span class="kinfo"><?php echo $LANG["api-token-desc"]; ?></span>
                    </div>
                </div>

                <div class="formcon">
                    <div class="yuzde30"><?php echo $LANG["origin-name"]; ?></div>
                    <div class="yuzde70">
                        <input type="text" name="origin" value="<?php echo $CONFIG["origin"]; ?>">
                        <span class="kinfo"><?php echo $LANG["origin-name-desc"]; ?></span>
                    </div>
                </div>

                <div class="formcon">
                    <div class="yuzde30"><?php echo $LANG["balance-info"]; ?></div>
                    <div class="yuzde70" id="ExampleSMS_get_credit"><?php echo $LANG["balance-info-desc"]; ?></div>
                </div>

                <div style="float:right;" class="guncellebtn"><a id="ExampleSMS_submit" href="javascript:void(0);" class="yesilbtn gonderbtn"><?php echo $LANG["save-button"]; ?></a></div>

            </form>
            <script type="text/javascript">
                var value = $("#ExampleSMS_get_credit").html();
                var loadBalanceExampleSMS;

                $(document).ready(function() {

                    setInterval(function() {
                        var display = $("#module-ExampleSMS").css("display");
                        if (display != "none") {
                            if (!loadBalanceExampleSMS) {

                                var request = MioAjax({
                                    action: window.location.href,
                                    method: "POST",
                                    data: {
                                        operation: "module_controller",
                                        module: "ExampleSMS",
                                        controller: "get-credit"
                                    }
                                }, true, true);

                                request.done(function(result) {
                                    ExampleSMS_get_credit(result);
                                });

                                loadBalanceExampleSMS = true;
                            }
                        }
                    }, 300);

                    $("#ExampleSMS_get_credit").html(window.value.replace("{credit}", '<?php echo ___("needs/loading-element"); ?>'));

                    $("#ExampleSMS_submit").click(function() {
                        MioAjaxElement($(this), {
                            waiting_text: waiting_text,
                            progress_text: progress_text,
                            result: "ExampleSMSSettings_handler",
                        });
                    });
                });

                function ExampleSMS_get_credit(result) {
                    if (result != '') {
                        var solve = getJson(result);
                        if (solve !== false) {
                            $("#ExampleSMS_get_credit").html(window.value.replace("{credit}", solve.credit));

                        } else
                            console.log(result);
                    }
                }

                function ExampleSMSSettings_handler(result) {
                    if (result != '') {
                        var solve = getJson(result);
                        if (solve !== false) {
                            if (solve.status == "error") {
                                if (solve.for != undefined && solve.for != '') {
                                    $("#ExampleSMSSettings " + solve.for).focus();
                                    $("#ExampleSMSSettings " + solve.for).attr("style", "border-bottom:2px solid red; color:red;");
                                    $("#ExampleSMSSettings " + solve.for).change(function() {
                                        $(this).removeAttr("style");
                                    });
                                }
                                if (solve.message != undefined && solve.message != '')
                                    alert_error(solve.message, {
                                        timer: 5000
                                    });
                            } else if (solve.status == "successful")
                                alert_success(solve.message, {
                                    timer: 2500
                                });
                        } else
                            console.log(result);
                    }
                }
            </script>

        </div>

        <!-- Admin Template -->
        <div id="admin-template" class="tabcontent">
            <div class="verticaltabstitle">
                <h2>Admin Template</h2>
            </div>

            <form action="<?php echo Controllers::$init->getData("links")["controller"]; ?>" method="post" class="admin-template-form">

                <?php

                foreach ($hooks_array as $hook_name => $hooks) {
                    $check = ucfirst(trim($hook_name)) . "Check";
                    $message = ucfirst(trim($hook_name)) . "Message";
                    $number = ucfirst(trim($hook_name)) . "Number";
                ?>

                    <div class="formcon">

                        <div class="yuzde30 sms_net_bd">
                            <input type="checkbox" name="<?= $check ?>" <?= $CONFIG[$check] ? 'checked' : ''; ?>>
                            <strong> <?= ucfirst(trim($hook_name)) ?> </strong>
                        </div>

                        <div class="yuzde70">
                            <label style="text-align: start;"> <?= $hooks["perameter"] ?> </label>
                            <input type="text" class="padding10" name="<?= $message; ?>" value="<?= !empty($CONFIG[$message]) ? $CONFIG[$message] : $hooks['message'] ; ?>">
                        </div>

                        <div class="yuzde30 sms_net_bd">
                            <span><?= $LANG["AdminNumber"]; ?></span>
                        </div>

                        <div class="yuzde70">
                            <input type="text" class="padding10" minlength="11" name="<?= $number ?>" value="<?= !empty($CONFIG[$number]) ? $CONFIG[$number] : ''; ?>">
                        </div>

                    </div>
                <?php

                }

                ?>

                <div style="float:right;" class="guncellebtn"><a href="javascript:void(0);" class="admin-template yesilbtn gonderbtn"><?php echo $LANG["save-admin-template"]; ?></a></div>

            </form>

        </div>

        <!-- SMS Send -->
        <div id="send-sms" class="tabcontent">

            <div class="verticaltabstitle">
                <h2>SMS Send</h2>
            </div>

            <form action="" method="post">
                <input type="hidden" name="sent-sms" value="send-sms">

                <div class="formcon">
                    <div class="yuzde30">Number</div>
                    <div class="yuzde70">
                        <input type="text" id="recipientNumber" name="recipientNumber" value="" placeholder="Enter recipient number">
                        <span class="kinfo"></span>
                    </div>
                </div>

                <div class="formcon">
                    <div class="yuzde30">Message</div>
                    <div class="yuzde70">
                        <textarea name="message" id="message" placeholder="Enter your message" rows="2"></textarea>
                    </div>
                </div>

                <div style="float:right;" class="guncellebtn">
                    <button type="button" class="yesilbtn gonderbtn send-sms"> <i class="fa fa-send"></i> Send SMS</button>
                </div>

            </form>

        </div>
    </div>
</div>



<!-- Tab Functionality -->
<script>
    $(document).ready(function() {
        $(".tablinks").click(function() {

            $(".tablinks").removeClass("active");
            $(this).addClass("active");

            $(".tabcontent").removeClass("active");
            var tabName = $(this).attr("data-tab");
            $("#" + tabName).addClass("active");
        });
    });
</script>

<!-- Message sending -->
<script>
    $(document).ready(function() {

        $(".send-sms").click(function() {
            var recipientNumber = $("#recipientNumber").val();
            var message = $("#message").val();

            // Basic validation
            if (recipientNumber === "" || message === "") {
                alert_error("Both recipient number and message are required.", {
                    timer: 2500
                });
                return;
            }

            var request = MioAjax({
                action: window.location.href,
                method: "POST",
                data: {
                    operation: "module_controller",
                    module: "ExampleSMS",
                    controller: "send",
                    recipientNumber: recipientNumber,
                    message: message
                }
            }, true, true);

            request.done(function(result) {
                var solve = getJson(result);
                console.log(result);

                if (solve.error == 0) {
                    alert_success(solve.msg, {
                        timer: 2500
                    });
                } else {
                    alert_error(solve.msg, {
                        timer: 2500
                    });
                }
            });
        });

    });
</script>

<!-- Admin template functionality  -->

<script>
    $(document).ready(function() {
        $(".admin-template").click(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Function to get the value of an input field
            function getInputData(name) {
                var $input = $("input[name='" + name + "']");
                if ($input.is(":checkbox")) {
                    return $input.is(":checked") ? 1 : 0;
                }
                return $input.val();
            }

            // Collecting form data dynamically into an object
            var formData = {};
            <?php foreach ($hooks_array as $key => $hook) { ?>
                formData["<?= $key . 'Check'; ?>"] = getInputData("<?= $key . 'Check'; ?>");
                formData["<?= $key . 'Message'; ?>"] = getInputData("<?= $key . 'Message'; ?>");
                formData["<?= $key . 'Number'; ?>"] = getInputData("<?= $key . 'Number'; ?>");
            <?php } ?>

            // Extend form data with additional values
            $.extend(formData, {
                operation: "module_controller",
                module: "ExampleSMS",
                controller: "admin-template"
            });

            // Send the AJAX request
            var request = MioAjax({
                action: window.location.href,
                method: "POST",
                data: formData // Use the dynamically created form data
            }, true, true);

            // Handle the response
            request.done(function(result) {
                var solve = getJson(result); // Parse the JSON response
                console.log(result);

                if (solve.error == 0) {
                    alert_success(solve.msg, {
                        timer: 2500
                    });
                } else {
                    alert_error(solve.msg, {
                        timer: 2500
                    });
                }
            });
        });
    });
</script>


<!-- 
    // $(".admin-template").click(function(e) {
    //     e.preventDefault(); // Prevent default form submission

    //     // Collecting form data into a FormData object
    //     var formData = new FormData($(".admin-template-form")[0]); // Pass the DOM element of the form

    //     // Add additional data to the FormData object
    //     formData.append("operation", "module_controller");
    //     formData.append("module", "ExampleSMS");
    //     formData.append("controller", "admin-template");

    //     // Send the AJAX request
    //     var request = MioAjax({
    //         action: window.location.href,
    //         method: "POST",
    //         data: formData, // Pass the FormData object
    //         contentType: false, // Required for FormData
    //         processData: false, // Prevent jQuery from processing FormData
    //     }, true, true);

    //     // Handle the response
    //     request.done(function(result) {
    //         var solve = getJson(result); // Parse the JSON response
    //         console.log(result);

    //         if (solve.error == 0) {
    //             alert_success(solve.msg, {
    //                 timer: 2500
    //             });
    //         } else {
    //             alert_error(solve.msg, {
    //                 timer: 2500
    //             });
    //         }
    //     });
    // }); -->