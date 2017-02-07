<?php

return [
    "PROJECT" => array(
        "title" => "深圳研发团队加班调休系统",
        "logo" => null,
        "current_control" => "",
        "current_action" => "",
        "menu" => array(
            "user_control" => array(
                "control_name" => "用户模块",
                "control_status" => "",
                "control_icon" => "user",
                "control_link" => "Index/index",
                "control_sub" => array(
                    "user_show" => array(
                        "sub_name" => "用户列表",
                        "sub_link" => "Index/index",
                        "sub_status" => "",
                    ),
                    "user_add" => array(
                        "sub_name" => "添加用户",
                        "sub_link" => "User/add",
                        "sub_status" => "",
                    ),
                )
            ),
            "manage_control" => array(
                "control_name" => "加班/调休管理",
                "control_status" => "",
                "control_icon" => "user",
                "control_link" => "Manage/show",
                "control_sub" => array(
                    "manage_show" => array(
                        "sub_name" => "加班/調休列表",
                        "sub_link" => "Manage/show",
                        "sub_status" => "",
                    ),
                    "manage_add" => array(
                        "sub_name" => "添加加班/調休",
                        "sub_link" => "Manage/add",
                        "sub_status" => "",
                    ),
                )
            ),
            "statistics_control" => array(
                "control_name" => "加班统计",
                "control_icon" => "gift",
                "control_link" => "Statistics/index",
                "control_status" => "",
            ),
        ),

    ),
];