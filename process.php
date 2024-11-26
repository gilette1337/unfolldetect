<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

function load_json_file($filename) {
    return json_decode(file_get_contents($filename), true);
}

function extract_usernames_followers($data) {
    $usernames = [];
    foreach ($data as $item) {
        if (isset($item['string_list_data'])) {
            foreach ($item['string_list_data'] as $user) {
                $usernames[] = $user['value'];
            }
        }
    }
    return $usernames;
}

function extract_usernames_following($data) {
    $usernames = [];
    if (isset($data['relationships_following'])) {
        foreach ($data['relationships_following'] as $item) {
            if (isset($item['string_list_data'])) {
                foreach ($item['string_list_data'] as $user) {
                    $usernames[] = $user['value'];
                }
            }
        }
    }
    return $usernames;
}

$followingFile = $_FILES['followingFile']['tmp_name'];
$followersFile = $_FILES['followersFile']['tmp_name'];

echo "[*] Checking Followings...\n\n";
$following_data = load_json_file($followingFile);
$following_usernames = extract_usernames_following($following_data);
echo "[*] Total Followings: " . count($following_usernames) . "\n\n";
echo "-----------------------------------------------------------------\n\n";
echo "[*] Checking Followers...\n\n";
$followers_data = load_json_file($followersFile);
$followers_usernames = extract_usernames_followers($followers_data);
echo "[*] Total Followers: " . count($followers_usernames) . "\n\n";
echo "-----------------------------------------------------------------\n\n";
echo "[*] Checking Unfollowers...\n\n";
$unfollowers = array_diff($following_usernames, $followers_usernames);
echo "[*] Total Unfollowers: " . count($unfollowers) . "\n\n";

if (!empty($unfollowers)) {
    echo "-----------------------------------------------------------------\n\n";
    echo "[*] Here are the usernames that Not Following you back / Unfollowed you:\n";
    foreach ($unfollowers as $username) {
        echo "--> $username\n";
    }
    echo "\n\n";
} else {
    echo "There are no Unfollowers!\n\n";
}
flush();
?>