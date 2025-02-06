<?php

if (!defined("CORE_FOLDER")) die();

$lang = $module->lang;
$config = $module->config;

// Initialize POST parameters
$api_token = (string) Filter::init("POST/api-token", "hclear");
$origin = (string) Filter::init("POST/origin", "hclear");

$sets = [];

// Update API token and origin if changed
if ($api_token !== $config["api-token"]) $sets["api-token"] = $api_token;
if ($origin !== $config["origin"]) $sets["origin"] = $origin;


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
            'status' => "successful",
            'message' => $lang["success1"], // Define success message in language file
        ]);
    } else {
        echo Utility::jencode([
            'status' => "error",
            'message' => $lang["error1"], // Define error message in language file
        ]);
    }
} else {
    echo Utility::jencode([
        'status' => "successful",
        'message' => $lang["no-changes"], // Define no changes message in language file
    ]);
}
?>
