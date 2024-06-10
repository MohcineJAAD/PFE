<?php
include("functions.php");

$query = "SELECT * from `notifications` order by `date` DESC";
$notifications = fetchAll($query);
$count = count(fetchAll("SELECT * from `notifications` where `status` = 'unread' order by `date` DESC"));

$response = [
    'list' => '',
    'count' => $count
];

if ($notifications) {
    foreach ($notifications as $i) {
        $style = $i['status'] == 'unread' ? 'font-weight:bold;' : '';
        $message = $i['type'] == 'comment' ? ucfirst($i['name']) . " commented on your post." : ucfirst($i['name']) . " liked your post.";
        $response['list'] .= "
            <a style=\"$style\" class=\"dropdowns-item\" href=\"view.php?id={$i['id']}\">
                <small><i>" . date('F j, Y, g:i a', strtotime($i['date'])) . "</i></small><br/>
                $message
            </a>
            <div class=\"dropdowns-divider\"></div>
        ";
    }
} else {
    $response['list'] = "No Records yet.";
}

echo json_encode($response);
?>
