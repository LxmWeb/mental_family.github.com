<?php

/*
 * TestGuest Version 1.0
 * ==============================
 * Copy 2016
 * Web:http://www.com
 * ==============================
 * Author: LXM
 * Date: 2017年3月5日
 */

/**
 * 根据医生ID，病人ID判断是否能够查看病人的信息，若能，则返回病人的信息，否则返回空
 * 通过在html页面判断返回值
 * 
 * @param string $id            
 */
// function show_patient_info($doctorId, $patientId)
// {
//     if (is_relative($doctorId, $patientId)) {
//         $sql = "select * from patient patient_id=$patientId";
//         $result = get_datas($sql);
//     } else {
//         $result = null;
//     }
//     return json_encode($result);
// }

/**
 * 根据医生ID显示医生的信息
 * 
 * @param string $id            
 */
// function show_doctor_info($id)
// {
//     $sql = "select * from doctor where doctor_id=$id";
//     $result = get_datas($sql);
//     return json_encode($result);
// }

?>