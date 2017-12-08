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
                "control_icon" => "calendar",
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
                "control_icon" => "dashboard",
                "control_link" => "Statistics/index",
                "control_status" => "",
            ),

            "rule_control" => array(
                "control_name" => "加班调休制度",
                "control_icon" => "tag",
                "control_link" => "Rule/index",
                "control_status" => "",
            ),
            "flow_control" => array(
                "control_name" => "项目管理流程",
                "control_status" => "",
                "control_icon" => "tasks",
                "control_link" => "Flow/flowControl",
                "control_sub" => array(
                    "flow_control" => array(
                        "sub_name" => "版本控制流程",
                        "sub_link" => "Flow/flowControl",
                        "sub_status" => "",
                    ),
                    "flow_chan" => array(
                        "sub_name" => "禅道项目管理流程全图",
                        "sub_link" => "Flow/chanDao",
                        "sub_status" => "",
                    ),
                    "flow_product" => array(
                        "sub_name" => "产品组核心工作流程",
                        "sub_link" => "Flow/productGroup",
                        "sub_status" => "",
                    ),
                    "flow_project" => array(
                        "sub_name" => "项目流程图",
                        "sub_link" => "Flow/projectFlow",
                        "sub_status" => "",
                    ),
                    "flow_implement" => array(
                        "sub_name" => "项目实施具体工作",
                        "sub_link" => "Flow/implement",
                        "sub_status" => "",
                    ),
                    "flow_demand" => array(
                        "sub_name" => "需求变更流程图",
                        "sub_link" => "Flow/demand",
                        "sub_status" => "",
                    ),
                )
            ),
        ),

    ),
];