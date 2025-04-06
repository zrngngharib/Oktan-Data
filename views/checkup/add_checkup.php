<?php
session_start();
include '../../includes/db.php'; // ڕێڕەویەکە گۆڕە بۆ پڕۆژەکەت
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>فۆڕمی پشکنینی ڕۆژانە</title>

    <!-- Bootstrap RTL + TailwindCSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        @font-face {
            font-family: 'Zain';
            src: url('../../fonts/Zain.ttf');
        }
        body {
            font-family: 'Zain', sans-serif;
            background: linear-gradient(135deg, #dee8ff, #f5f7fa);
        }
        .glass {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
            padding: 20px;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            color:rgb(35, 35, 35);
        }
        .section-title {
            background-color: #4F46E5;
            color: white;
            padding: 10px 20px;
            border-radius: 12px;
            margin-bottom: 10px;
            font-size: 1.25rem;
        }
    </style>
</head>

<body class="container py-4">

    <h2 class="text-center text-3xl text-indigo-700 font-bold mb-6">📝 فۆڕمی پشکنینی ڕۆژانە</h2>

    <form action="save_checkup.php" method="POST" enctype="multipart/form-data">

        <!-- ✅ بەشی ١ : مۆلیدەکان -->
        <div class="glass">
            <div class="section-title"><i class="fa-solid fa-bolt"></i> مۆلیدەکان</div>

            <!-- مولیدە 1 -->
            <div class="row mb-3">
                <div class="col-md-2 fw-bold text-indigo-800">مۆلیدەی 1 - 500kv</div>
                <div class="col-md-2"><label>لۆد</label><input type="number" name="gen1_load" class="form-control" ></div>
                <div class="col-md-2"><label>پلەی گەرمی</label><input type="number" name="gen1_temp" class="form-control" ></div>
                <div class="col-md-2"><label>OP.bar</label><input type="number" name="gen1_op_bar" class="form-control" ></div>
                <div class="col-md-2"><label>FP.bar</label><input type="number" name="gen1_fp_bar" class="form-control" ></div>
                <div class="col-md-2"><label>کاتژمێر</label><input type="number" name="gen1_hours" class="form-control" ></div>
            </div>

            <!-- مولیدە 2 -->
            <div class="row mb-3">
                <div class="col-md-2 fw-bold text-indigo-800">مۆلیدەی 2 - 500kv</div>
                <div class="col-md-2"><label>لۆد</label><input type="number" name="gen2_load" class="form-control" ></div>
                <div class="col-md-2"><label>پلەی گەرمی</label><input type="number" name="gen2_temp" class="form-control" ></div>
                <div class="col-md-2"><label>OP.bar</label><input type="number" name="gen2_op_bar" class="form-control" ></div>
                <div class="col-md-2"><label>FP.bar</label><input type="number" name="gen2_fp_bar" class="form-control" ></div>
                <div class="col-md-2"><label>کاتژمێر</label><input type="number" name="gen2_hours" class="form-control" ></div>
            </div>

            <!-- مولیدە 3 -->
            <div class="row mb-3">
                <div class="col-md-2 fw-bold text-indigo-800">مۆلیدەی 3 - 500kv</div>
                <div class="col-md-2"><label>لۆد</label><input type="number" name="gen3_load" class="form-control" ></div>
                <div class="col-md-2"><label>پلەی گەرمی</label><input type="number" name="gen3_temp" class="form-control" ></div>
                <div class="col-md-2"><label>OP.bar</label><input type="number" name="gen3_op_bar" class="form-control" ></div>
                <div class="col-md-2"><label>FP.bar</label><input type="number" name="gen3_fp_bar" class="form-control" ></div>
                <div class="col-md-2"><label>کاتژمێر</label><input type="number" name="gen3_hours" class="form-control" ></div>
            </div>

            <!-- مولیدە 4 -->
            <div class="row mb-3">
                <div class="col-md-2 fw-bold text-indigo-800">مۆلیدەی 4 - 1000kv</div>
                <div class="col-md-2"><label>لۆد</label><input type="number" name="gen4_load" class="form-control" ></div>
                <div class="col-md-2"><label>پلەی گەرمی</label><input type="number" name="gen4_temp" class="form-control" ></div>
                <div class="col-md-2"><label>OP.bar</label><input type="number" name="gen4_op_bar" class="form-control" ></div>
                <div class="col-md-2"><label>FP.bar</label><input type="number" name="gen4_fp_bar" class="form-control" ></div>
                <div class="col-md-2"><label>کاتژمێر</label><input type="number" name="gen4_hours" class="form-control" ></div>
            </div>
        </div>

        <!-- ✅ بەشی ٢ : سوتەمەنی -->
        <div class="glass">
            <div class="section-title"><i class="fa-solid fa-gas-pump"></i> سوتەمەنی</div>

            <div class="row">
                <div class="col-md-6">
                    <label>گاز بە ڕێژەی سەدی (%)</label>
                    <input type="number" name="fuel_gas" class="form-control" >
                </div>
                <div class="col-md-6">
                    <label>LPG بە ڕێژەی سەدی (%)</label>
                    <input type="number" name="fuel_lpg" class="form-control" >
                </div>
            </div>
        </div>

        <!-- ✅ بەشی ٣ : ATS -->
        <div class="glass">
            <div class="section-title"><i class="fa-solid fa-plug"></i> ATS</div>

            <div class="row">
                <div class="col-md-4">
                    <label>لۆد (A)</label>
                    <input type="number" name="ats_load" class="form-control" >
                </div>
                <div class="col-md-4">
                    <label>پلەی گەرمی ژور</label>
                    <input type="number" name="ats_temp" class="form-control" >
                </div>
                <div class="col-md-4">
                    <label>کیلۆ وات KW</label>
                    <input type="number" name="ats_kw" class="form-control" >
                </div>
            </div>
        </div>

        <!-- ✅ بەشی ٤ : کارگەری ئۆکسجین -->
        <div class="glass">
            <div class="section-title"><i class="fa-solid fa-wind"></i> کارگەری ئۆکسجین</div>

            <div class="row">
                <div class="col-md-3">
                    <label>کۆمپرێسەر pre/bar</label>
                    <input type="number" name="oxygen_compressor_bar" class="form-control" >
                </div>
                <div class="col-md-3">
                    <label>پلەی گەرمی</label>
                    <input type="number" name="oxygen_temp" class="form-control" >
                </div>
                <div class="col-md-3">
                    <label>کاتژمێری کارکردن</label>
                    <input type="number" name="oxygen_hours" class="form-control" >
                </div>
                <div class="col-md-3">
                    <label>نەقاوە/خاوێنی</label>
                    <input type="text" name="oxygen_quality" class="form-control" >
                </div>
            </div>

            <div class="form-check mt-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="oxygen_dryer" value="working" > درایەر - کاردەکات
                </label>
            </div>
        </div>

        <!-- ✅ بەشی ٥ : بتڵی ئۆکجسین -->
        <div class="glass">
            <div class="section-title"><i class="fa-solid fa-wind"></i> بتڵی ئۆکجسین O2</div>

            <div class="row">
                <div class="col-md-4">
                    <label>ڕاست</label>
                    <input type="number" name="o2_right" class="form-control" >
                </div>
                <div class="col-md-4">
                    <label>چەپ</label>
                    <input type="number" name="o2_left" class="form-control" >
                </div>
                <div class="col-md-4">
                    <label>دەرچوون</label>
                    <input type="number" name="o2_out" class="form-control" >
                </div>
            </div>
        </div>

        <!-- ✅ بەشی ٦ : میکانیکی دەرەوە -->
        <div class="glass">
            <div class="section-title"><i class="fa-solid fa-gears"></i> میکانیکی دەرەوە</div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label>بۆیلەر 1</label>
                    <input type="number" name="boiler1" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>بۆیلەر 2</label>
                    <input type="number" name="boiler2" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>بێرنەر 1</label>
                    <input type="number" name="burner1" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>بێرنەر 2</label>
                    <input type="number" name="burner2" class="form-control">
                </div>
            </div>


            <div class="row mt-3">
                <div class="col-md-3">
                    <label>سۆفت نەر</label>
                    <select name="softener" class="form-select">
                        <option value="کاردەکات" selected>کاردەکات</option>
                        <option value="کار ناکات">کار ناکات</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>RO ڕاست</label>
                    <input type="number" name="ro_right" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>RO چەپ</label>
                    <input type="number" name="ro_left" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>خوێ</label>
                    <select name="blood_status" class="form-select">
                        <option value="تێیدایە" selected>تێیدایە</option>
                        <option value="تێییکراوە">تێییکراوە</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>داینەمۆ 1</label>
                    <select name="dynamo1_status" class="form-select">
                        <option value="کاردەکات" selected>کاردەکات</option>
                        <option value="کار ناکات">کار ناکات</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>داینەمۆ 2</label>
                    <select name="dynamo2_status" class="form-select">
                        <option value="کاردەکات" selected>کاردەکات</option>
                        <option value="کار ناکات">کار ناکات</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- ✅ بەشی ٧ : چیلەر -->
        <div class="glass">
            <div class="section-title"><i class="fa-solid fa-snowflake"></i> چیلەر</div>

            <div class="row">
                <div class="col-md-3">
                    <label>چیلەری 1 IN</label>
                    <input type="number" name="chiller1_in" class="form-control" >
                </div>
                <div class="col-md-3">
                    <label>چیلەری 1 OUT</label>
                    <input type="number" name="chiller1_out" class="form-control" >
                </div>
                <div class="col-md-3">
                    <label>چیلەری 2 IN</label>
                    <input type="number" name="chiller2_in" class="form-control" >
                </div>
                <div class="col-md-3">
                    <label>چیلەری 2 OUT</label>
                    <input type="number" name="chiller2_out" class="form-control" >
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label>چیلەری 3 IN</label>
                    <input type="number" name="chiller3_in" class="form-control" >
                </div>
                <div class="col-md-3">
                    <label>چیلەری 3 OUT</label>
                    <input type="number" name="chiller3_out" class="form-control" >
                </div>
                <div class="col-md-3">
                    <label>چیلەری 4 IN</label>
                    <input type="number" name="chiller4_in" class="form-control" >
                </div>
                <div class="col-md-3">
                    <label>چیلەری 4 OUT</label>
                    <input type="number" name="chiller4_out" class="form-control" >
                </div>
            </div>
        </div>

        <!-- ✅ بەشی ٨ : پارک -->
        <div class="glass">
            <div class="section-title"><i class="fa-solid fa-tree"></i> پارک</div>

            <div class="row">
                <div class="col-md-3">
                    <label>وەتەر تەیمێنت</label>
                    <select name="water_treatment_status" class="form-select">
                        <option value="کاردەکات" selected>کاردەکات</option>
                        <option value="کار ناکات">کار ناکات</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>کلۆر</label>
                    <select name="chlor_status" class="form-select">
                        <option value="کاردەکات" selected>کاردەکات</option>
                        <option value="کار ناکات">کار ناکات</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>گڵۆپی پارک</label>
                    <select name="park_globe_status" class="form-select">
                        <option value="کاردەکات" selected>کاردەکات</option>
                        <option value="کار ناکات">کار ناکات</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>حەوزی پیسایی</label>
                    <select name="pool_status" class="form-select">
                        <option value="کاردەکات" selected>ئاساییە</option>
                        <option value="کار ناکات">نزیكە لە پڕبوون</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- ✅ بەشی ٩ : ژوری ڤاکیۆم -->
        <div class="glass p-4 mt-4">
            <div class="section-title mb-3">
                <i class="fa-solid fa-fan"></i></i> ژوری ڤاکیۆم
            </div>

            <!-- ڤاکیۆمەکان -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="vacuum"><i class="fa-solid fa-fan"></i> ڤاکیۆم</label>
                    <select name="vacuum" id="vacuum" class="form-select">
                        <option value="کاردەکات" selected>کاردەکات</option>
                        <option value="کارناکات">کارناکات</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="vacuum_power"><i class="fa-solid fa-bolt"></i> هێز</label>
                    <input type="number" name="vacuum_power" id="vacuum_power" class="text-right form-control" placeholder="کاتژمێری کارکردن ..." >
                </div>
                <div class="col-md-3">
                    <label for="vacuum_temp"><i class="fa-solid fa-temperature-high"></i> پلەی گەرمی</label>
                    <input type="number" name="vacuum_temp" id="vacuum_temp" class="text-right form-control" placeholder="بە °C ..." >
                </div>
                <div class="col-md-3">
                    <label for="vacuum_oil"><i class="fa-solid fa-oil-can"></i> ئاستی ڕۆن</label>
                    <input type="text" name="vacuum_oil" id="vacuum_oil" class="text-right form-control" placeholder="ڕۆن لە %" >
                </div>
            </div>

            <!-- ✅ کۆمپرێسەری نەشتەرگەری لای ڕاست -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label><i class="fa-solid fa-arrow-right"></i> کۆمپرێسەری هەوا 1</label>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="surgery_comp_right_power"><i class="fa-solid fa-bolt"></i> هێز</label>
                            <input type="number" name="surgery_comp_right_power" id="surgery_comp_right_power" class="text-right form-control" placeholder="هێز  " >
                        </div>
                        <div class="col-md-6">
                            <label for="surgery_comp_right_temp"><i class="fa-solid fa-temperature-high"></i> پلەی گەرمی</label>
                            <input type="number" name="surgery_comp_right_temp" id="surgery_comp_right_temp" class="text-right form-control" placeholder="پلەی گەرمی °C..." >
                        </div>
                    </div>
                </div>

                <!-- ✅ کۆمپرێسەری نەشتەرگەری لای چەپ -->
                <div class="col-md-6">
                    <label><i class="fa-solid fa-arrow-left"></i> کۆمپرێسەری هەوا 2</label>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="surgery_comp_left_power"><i class="fa-solid fa-bolt"></i> هێز</label>
                            <input type="number" name="surgery_comp_left_power" id="surgery_comp_left_power" class="text-right form-control" placeholder="هێز  " >
                        </div>
                        <div class="col-md-6">
                            <label for="surgery_comp_left_temp"><i class="fa-solid fa-temperature-high"></i> پلەی گەرمی</label>
                            <input type="number" name="surgery_comp_left_temp" id="surgery_comp_left_temp" class="text-right form-control" placeholder="پلەی گەرمی °C..." >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ✅ بەشی 10 : میکانیکی ناوەوە -->
        <div class="glass p-4 mt-4">
            <div class="section-title mb-3">
                <i class="fa-solid fa-cogs "></i> میکانیکی قاتی (B) 
            </div>

            <!-- ✅ داینەمۆکان -->
            <div class="mb-4">
                <label class="fw-bold"><i class="fa-solid fa-engine-warning"></i> داینەمۆکان</label>
                <div class="row">

                    <!-- داینەمۆی ڕاست -->
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">
                            <h6 class="text-right"><i class="fa-solid fa-arrow-right"></i> داینەمۆی ڕاست</h6>
                            <select name="dynamo_right" class="form-select">
                                <option value="کاردەکات" selected>کاردەکات</option>
                                <option value="کارناکات">کارناکات</option>
                            </select>
                        </div>
                    </div>

                    <!-- داینەمۆی ناوەڕاست -->
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">
                            <h6 class="text-right"><i class="fa-solid fa-arrows-left-right"></i> داینەمۆی ناوەڕاست</h6>
                            <select name="dynamo_middle" class="form-select">
                                <option value="کاردەکات" selected>کاردەکات</option>
                                <option value="کارناکات">کارناکات</option>
                            </select>
                        </div>
                    </div>

                    <!-- داینەمۆی چەپ -->
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">
                            <h6 class="text-right"><i class="fa-solid fa-arrow-left"></i> داینەمۆی چەپ</h6>
                            <select name="dynamo_left" class="form-select">
                                <option value="کاردەکات" selected>کاردەکات</option>
                                <option value="کارناکات">کارناکات</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ✅ بۆیلەری RO -->
            <div class="mb-4">
                <label class="fw-bold"><i class="fa-solid fa-burn"></i> بۆیلەری RO</label>
                <div class="row">

                    <!-- بۆیلەری ١ -->
                    <div class="col-md-6 mb-3">
                        <div class="card p-3">
                            <h6 class="text-right"><i class="fa-solid fa-temperature-low"></i> بۆیلەری ١</h6>
                            <select name="ro_boiler_1" class="form-select">
                                <option value="کاردەکات" selected>کاردەکات</option>
                                <option value="کارناکات">کارناکات</option>
                            </select>
                        </div>
                    </div>

                    <!-- بۆیلەری ٢ -->
                    <div class="col-md-6 mb-3">
                        <div class="card p-3">
                            <h6 class="text-right"><i class="fa-solid fa-temperature-low"></i> بۆیلەری ٢</h6>
                            <select name="ro_boiler_2" class="text-right form-select">
                                <option value="کاردەکات" selected>کاردەکات</option>
                                <option value="کارناکات">کارناکات</option>
                            </select>
                        </div>
                    </div>
                    <!-- ✅ کۆمپرێسەری ددان لای ڕاست -->
                    <div class="col-md-6">
                        <label><i class="fa-solid fa-arrow-right"></i> کۆمپرێسەری هەوا 3</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="teeth_comp_right_power"><i class=" text-right fa-solid fa-bolt"></i> هێز</label>
                                <input type="number" name="teeth_comp_right_power" id="teeth_comp_right_power" class="text-right form-control" placeholder="هێز  " >
                            </div>
                            <div class="col-md-6">
                                <label for="teeth_comp_right_temp"><i class="text-right fa-solid fa-temperature-high"></i> پلەی گەرمی</label>
                                <input type="number" name="teeth_comp_right_temp" id="teeth_comp_right_temp" class="text-right form-control" placeholder="پلەی گەرمی °C..." >
                            </div>
                        </div>
                    </div>

                    <!-- ✅ کۆمپرێسەری ددان لای چەپ -->
                    <div class="col-md-6">
                        <label><i class="fa-solid fa-arrow-left"></i> کۆمپرێسەری هەوا 4</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="teeth_comp_left_power"><i class="fa-solid fa-bolt"></i> هێز</label>
                                <input type="number" name="teeth_comp_left_power" id="teeth_comp_left_power" class="text-right form-control" placeholder="هێز  " >
                            </div>
                            <div class="col-md-6">
                                <label for="teeth_comp_left_temp"><i class="fa-solid fa-temperature-high"></i> پلەی گەرمی</label>
                                <input type="number" name="teeth_comp_left_temp" id="teeth_comp_left_temp" class="text-right form-control" placeholder="پلەی گەرمی °C..." >
                            </div>
                        </div>
                    </div>
                    <!-- ✅ ڕێژەی ئاوی تانکی -->
                    <div class="row mt-3 text-right">
                        <div class="col-md-4">
                            <label for="tank1_percentage"><i class="text-right fa-solid fa-water"></i> ڕێژەی ئاوی تانکی ١</label>
                            <input type="number" name="tank1_percentage" id="tank1_percentage" class="text-right form-control" placeholder="ڕێژەی  ئاوی تانکی ١" >
                        </div>
                        <div class="col-md-4">
                            <label for="tank2_percentage"><i class="text-right fa-solid fa-water"></i> ڕێژەی ئاوی تانکی ٢</label>
                            <input type="number" name="tank2_percentage" id="tank2_percentage" class="text-right form-control" placeholder="ڕێژەی ئاوی  تانکی ٢" >
                        </div>
                        <div class="col-md-4">
                            <label for="tank3_percentage"><i class="text-right fa-solid fa-water"></i> ڕێژەی ئاوی تانکی ٣</label>
                            <input type="number" name="tank3_percentage" id="tank3_percentage" class="text-right form-control" placeholder="ڕێژەی ئاوی  تانکی ٣" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ✅ بەشی ١١: فطاسەکان -->
        <div class="glass p-4 mt-4">
            <div class="section-title mb-3">
                <i class="fa-solid fa-water"></i> غطاسەکان
            </div>

            <div class="row g-3">
                <!-- غطاسەکانی لای تعقیم -->
                <div class="col-md-6">
                    <div class="card p-3 ">
                        <h6><i class="fa-solid fa-tint"></i> تعقیم - لای ڕاست</h6>
                        <select name="taqim_right_status" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card p-3">
                        <h6><i class="fa-solid fa-tint"></i> تعقیم - لای چەپ</h6>
                        <select name="taqim_left_status" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <!-- غطاسی لای تاقیگە -->
                <div class="col-md-6">
                    <div class="card p-3">
                        <h6><i class="fa-solid fa-flask"></i> تاقیگە - لای ڕاست</h6>
                        <select name="lab_right_status" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card p-3">
                        <h6><i class="fa-solid fa-flask"></i> تاقیگە - لای چەپ</h6>
                        <select name="lab_left_status" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- ✅ بەشی 12: بەرزکەرەوکان -->
        <div class="glass p-4 mt-4">
            <div class="section-title mb-3">
                <i class="fa-solid fa-elevator "></i> بەرزکەرەوەکان (مسعد)
            </div>

            <div class="row g-3">
                <!-- خزمەتگوزاری -->
                <div class="col-md-4">
                    <div class="card p-3 ">
                        <h6><i class="fa-solid fa-hands-helping"></i> خزمەتگوزاری</h6>
                        <select name="elevator_service_status" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- نەشتەرگەری -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-user-nurse"></i> نەشتەرگەری</h6>
                        <select name="elevator_surgery_status" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- پێشەوە لای ڕاست -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-arrow-right"></i> پێشەوە لای ڕاست</h6>
                        <select name="elevator_forward_right_status" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- پێشەوە لای چەپ -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-arrow-left"></i> پێشەوە لای چەپ</h6>
                        <select name="elevator_forward_left_status" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- تاقیگە -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-vials"></i> سۆنەر</h6>
                        <select name="elevator_lab_status" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- نۆرینگە -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-radiation"></i> نۆرینگە</h6>
                        <select name="elevator_noringa_status" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- ✅ بەشی 13: UPS -->

        <div class="glass p-4 mt-4">
            <div class="section-title mb-3">
                <i class="fa-solid fa-battery-full "></i> UPS
            </div>

            <!-- UPS-B -->
            <div class="card p-3 mb-4">
                <h6><i class="fa-solid fa-plug-circle-check "></i> UPS - B</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label><i class="fa-solid fa-bolt"></i> لۆد</label>
                        <input type="number" name="ups_b_load" class="form-control" placeholder="لۆد  ">
                    </div>
                    <div class="col-md-4">
                        <label><i class="fa-solid fa-temperature-three-quarters"></i> پلەی گەرمی ژور</label>
                        <input type="number" name="ups_b_temp" class="form-control" placeholder="پلەی گەرمی">
                    </div>
                    <div class="col-md-4">
                        <label><i class="fa-solid fa-snowflake"></i> سپلیت</label>
                        <div class="form-check">
                            <input type="radio" name="ups_b_split" id="ups_b_split_on" value="کاردەکات" >
                            <label for="ups_b_split_on">کاردەکات</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="ups_b_split" id="ups_b_split_off" value="کارناکات">
                            <label for="ups_b_split_off">کارناکات</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- UPS-G -->
            <div class="card p-3">
                <h6><i class="fa-solid fa-plug-circle-check "></i> UPS - G</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label><i class="fa-solid fa-bolt"></i> لۆد</label>
                        <input type="number" name="ups_g_load" class="form-control" placeholder="لۆد  ">
                    </div>
                    <div class="col-md-4">
                        <label><i class="fa-solid fa-temperature-three-quarters"></i> پلەی گەرمی ژور</label>
                        <input type="number" name="ups_g_temp" class="form-control" placeholder="پلەی گەرمی">
                    </div>
                    <div class="col-md-4">
                        <label><i class="fa-solid fa-snowflake"></i> سپلیت</label>
                        <div class="form-check">
                            <input type="radio" name="ups_g_split" id="ups_g_split_on" value="کاردەکات" >
                            <label for="ups_g_split_on">کاردەکات</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="ups_g_split" id="ups_g_split_off" value="کارناکات">
                            <label for="ups_g_split_off">کارناکات</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- بەشی دافیعەکان -->
        <div class="glass p-4 mt-4">
            <div class="section-title mb-3">
                <i class="fa-solid fa-fan"></i> دافیعەکان
            </div>

            <div class="row g-3">

                <!-- قاتی B -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-layer-group "></i> قاتی B</h6>
                        <select name="dafia_b" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- قاتی G -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-layer-group "></i> قاتی G</h6>
                        <select name="dafia_g" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- قاتی 1 -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-layer-group "></i> قاتی ١</h6>
                        <select name="dafia_1" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- قاتی 2 -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-layer-group "></i> قاتی ٢</h6>
                        <select name="dafia_2" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- قاتی 3 -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-layer-group "></i> قاتی ٣</h6>
                        <select name="dafia_3" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- قاتی 4 -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-layer-group "></i> قاتی ٤</h6>
                        <select name="dafia_4" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- نۆرینگە -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-hospital "></i> نۆرینگە</h6>
                        <select name="dafia_norenga" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <!-- ژوری سێرڤەر -->
        <div class="glass p-4 mt-4">
            <div class="section-title mb-3">
                <i class="fa-solid fa-server"></i>  ژوری سێرڤەر
            </div>
            <div class="row g-3">

                <!-- سپلیت -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-wind "></i> سپلیت</h6>
                        <select name="server_split" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- پلەی گەرمی -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-temperature-high "></i> پلەی گەرمی</h6>
                    <div class="input-group mt-2">
                            <span class="input-group-text"><i class="fa-solid fa-thermometer-half"></i></span>
                            <input type="number" class="form-control" name="server_temp" placeholder="پلەی گەرمی °C" >
                        </div>
                    </div>
                </div>

                <!-- نێتوۆرک -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-network-wired "></i> نێتوۆرک</h6>
                        <select name="server_network" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- بەدالە -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-plug "></i> بەدالە</h6>
                        <select name="server_badala" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- کامێراکان -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-video "></i> کامێراکان</h6>
                        <select name="server_camera" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

                <!-- ئاگرکوژێنەوە -->
                <div class="col-md-4">
                    <div class="card p-3 text-right">
                        <h6><i class="fa-solid fa-fire-extinguisher "></i> سیستەمی ئاگرکەوتنەوە</h6>
                        <select name="server_fire_system" class="form-select">
                            <option value="کاردەکات" selected>کاردەکات</option>
                            <option value="کارناکات">کارناکات</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <!-- بەکارهێنەر و کات -->
        <div class="glass p-4 mt-4">
            <div class="section-title mb-3">
                <i class="fa-solid fa-user-clock "></i>بەکارهێنەر و بەروار 
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label><i class="fa-solid fa-user"></i> كارمەند</label>
                    <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($_SESSION['username']) ?>" readonly>
                </div>

                <div class="col-md-6">
                    <label><i class="fa-solid fa-calendar-day"></i> بەروار</label>
                    <input type="text" name="current_datetime" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" readonly>
                </div>
            </div>
        </div>

        <!-- بارکردنی وێنە -->
        <div class="glass p-4 mt-4">
            <div class="section-title mb-3">
                <i class="fa-solid fa-upload"></i>  بارکردنی وێنەکان 
            </div>
            <div id="dropArea" class="border-2 border-dashed border-indigo-600 rounded p-4 text-center">
                <p>🖱️ کلیک یان ڕابکێشە بۆ بارکردنی وێنەکان!</p>
                <input type="file" id="fileInput" name="file[]" multiple class="d-none" />
            </div>

            <div class="progress mt-3" style="height: 20px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    style="width: 0%;" id="uploadProgress">0%</div>
            </div>
        </div>
        <div class="glass p-4 mt-4">
            <div class="section-title mb-3">
                <i class="fa-solid fa-sticky-note"></i> تێبینی
            </div>
            <div class="mb-3">
                <label for="note"><i class="fa-solid fa-pen"></i> تێبینی</label>
                <textarea name="note" id="note" rows="4" class="form-control" placeholder="تێبینیەکانت لێرە بنووسە..."></textarea>
            </div>
        </div>

        <!-- تۆمارکردن -->
        <div class="text-center my-4">
            <button type="submit" class="btn btn-success px-4 py-2">
                <i class="fa-solid fa-floppy-disk"></i> تۆمارکردن
            </button>
        </div>

    </form>

</body>
</html>

<script>
    const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('fileInput');

    dropArea.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', async () => {
        const files = fileInput.files;
        const progress = document.getElementById('uploadProgress');

        if (files.length === 0) return;

        const formData = new FormData();
        [...files].forEach(file => formData.append("file", file));

        // Upload to Cloudinary with progress
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'upload_to_cloudinary.php', true);

        xhr.upload.addEventListener('progress', (e) => {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                progress.style.width = percentComplete + "%";
                progress.innerHTML = Math.round(percentComplete) + "%";
            }
        });

        xhr.onload = () => {
            const result = JSON.parse(xhr.responseText);
            if (result.success) {
                progress.style.width = "100%";
                progress.innerHTML = "✅ گەیەنرا بۆ Cloudinary";
                // Add the image URL as a hidden input field
                const imageUrlInput = document.createElement('input');
                imageUrlInput.type = 'hidden';
                imageUrlInput.name = 'images[]'; // Ensure the name matches the file input field
                imageUrlInput.value = result.url; // Add the URL directly
                document.querySelector('form').appendChild(imageUrlInput);
            } else {
                progress.style.width = "0%";
                progress.innerHTML = "❌ هەڵەیەک ڕوویدا: " + result.error;
            }
        };

        xhr.send(formData);
    });
</script>


