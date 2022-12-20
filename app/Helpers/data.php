<?php
function show_product($data, $parent_id = 0)
{
    foreach ($data as $key => $item) {
        if ($item['parent_id'] == $parent_id && $item['parent_id'] == 0) {
            echo '<div class="quizzes_section">';
            echo '<div class="quizzes_section_head">';
            echo $item['name'] . '<i class="fa-solid fa-pen"></i>';
            echo '</div>';
            unset($data[$key]);
            show_product($data, $item['id']);
        } else {
            echo '<div class="row">';
            echo '<div class="c-4">';
            echo '<div class="quizzes_section_item ">';
            echo '<i class="fa-solid fa-trash delete"></i>';
            echo '<img src="/storage/images/category/' . $item['thumb'] . '" alt="" class="img">';
            echo '<div class="text_head">' . $item['name'] . '</div>';
            echo '<div class="text_sub">' . $item['description'] . ' </div>';
            echo '<div class="wrap">';
            echo '<div class="lession"> 10 lession</div>';
            echo '<div class="edit">Edit<i class="fa-solid fa-pen"></i></div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
}
function check_Cat_Reg($listCatReg, $idCat)
{
    return array_keys(array_column($listCatReg, 'id'), $idCat);
}
function check_quiz_done($array, $id)
{
    foreach ($array as $quiz) {
        if ($quiz['quizcategory_id'] == $id) {
            return 'active-item';
        }
    }
}
function check_quiz_icon_done($array, $id)
{
    foreach ($array as $quiz) {
        if ($quiz['quizcategory_id'] == $id) {
            return '<i class="fas fa-check"></i>';
        }
    }
}
function tree_topic($array, $parent_id = 0, $char = '')
{
    foreach ($array as $key => $item) {
        if ($item['parent_id'] == $parent_id) {
            echo '<tr>';
            echo '<td>  <div class="userDatatable-content">' . $char . $item['name'] . '</div></td>';
            echo '<td>  <div class="userDatatable-content">' . type_topic($item['parent_id']) . '</div> </td>';
            echo '<td><div class="userDatatable-content">' . $item['description'] . '</div></td>';
            echo '<td><img style="width:50px;" class="thumb-table" src="' . url('storage/images/category/' . check_img_topic($item['thumb']) . '') . '" alt=""></td>';
            echo '<td> <div class="userDatatable-content">' . date('Y-m-d', strtotime($item['created_at'])) . '</div></td>';
            echo '<td> <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">';
            echo '<li> <a  href="#" data-id="' . $item['id'] . '" class="edit-button edit"><span  data-feather="edit"></span></a></li>';
            echo '<li><a  href="#" onclick = "deleteTopic(' . $item['id'] . ')" data-id ="' . $item['id'] . '" class="remove"><span data-feather="trash-2"></span></a> </li>';
            echo '</ul></td>';
            echo '</ul></tr>';
            unset($array[$key]);
            tree_topic($array, $item['id'], $char . '--');
        }
    }
}
function check_img_topic($img)
{
    if ($img != '') {
        return $img;
    }
    return 'channels4_profile.jpg';
}
function type_topic($parent_id)
{
    if ($parent_id == 0) {
        return 'Topic';
    }
    return 'Category';
}
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
