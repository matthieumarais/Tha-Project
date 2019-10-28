<div class="container pb-100">
<div class="mx-auto col-md-8">
<img src="assets/img/1.jpg" alt="">
<iframe width="100%" height="315" src="https://www.youtube.com/embed/CmMnRUMqPLs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<img src="assets/img/2.jpg" alt="">
<img src="assets/img/3.jpg" alt="">
<img src="assets/img/4.jpg" alt="">
<img src="assets/img/5.jpg" alt="">
<img src="assets/img/8.jpg" alt="">
<img src="assets/img/6.jpg" alt="">
<img src="assets/img/7.jpg" alt="">
</div>

    <form id="formStudents" action="goodbye" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="form-group">
                    <label for="">เลือกจังหวัดที่จะเข้าร่วมสัมนา (City selection)</label>
                    <select name="_city" id="city" class="form-control"  data-validation="required" data-validation-error-msg=" ">
                        <option data-pixel="" value="">เลือกจังหวัด (Select city)</option>
                        <option data-pixel="643456952848311" value="ประจวบคีรีขันธ์ (Prachuap)">16-Nov-2019 | ประจวบคีรีขันธ์ (Prachuap)</option>
                        <option data-pixel="2611079895580215" value="ชลบุรี (Chonburi)">17-Nov-2019 | ชลบุรี (Chonburi)</option>
                        <option data-pixel="529791667776085" value="นครราชสีมา (Nakhon Ratchasima)">23-Nov-2019 | นครราชสีมา (Nakhon Ratchasima)</option>
                        <option data-pixel="637316986798533" value="บุรีรัมย์ (Buriram)">24-Nov-2019 | บุรีรัมย์ (Buriram)</option>
                        <option data-pixel="510841836423182" value="อุดรธานี (Udon)">30-Nov-2019 | อุดรธานี (Udon)</option>
                        <option data-pixel="548253955913206" value="สกลนคร (Sakon Nakhon)">01-Dec-2019 | สกลนคร (Sakon Nakhon)</option>
                        <option data-pixel="524740538323862" value="อุบลราชธานี (Ubon)">07-Dec-2019 | อุบลราชธานี (Ubon)</option>
                        <option data-pixel="693735021095773" value="ศรีสะเกษ (Srisaket)">08-Dec-2019 | ศรีสะเกษ (Srisaket)</option>
                        <option data-pixel="2764089166977341" value="ร้อยเอ็ด (Roi Et)">14-Dec-2019 | ร้อยเอ็ด (Roi Et)</option>
                        <option data-pixel="366955897587811" value="ขอนแก่น (Khon Kaen)">15-Dec-2019 | ขอนแก่น (Khon Kaen)</option>
                        <option data-pixel="1065016063889814" value="สุราษฎร์ธานี (Surat Thani)">21-Dec-2019 | สุราษฎร์ธานี (Surat Thani)</option>
                        <option data-pixel="432408277395365" value="ภูเก็ต (Phuket)">22-Dec-2019 | ภูเก็ต (Phuket)</option>
                        <option data-pixel="440921543190751" value="นครศรีธรรมราช (Nakhon Si Thammarat)">11-Jan-2020 | นครศรีธรรมราช (Nakhon Si Thammarat)</option>
                        <option data-pixel="379155299678564" value="หาดใหญ่ (Hat Yai)">12-Jan-2020 | หาดใหญ่ (Hat Yai)</option>
                        <option data-pixel="514741812661817" value="กรุงเทพฯ (Bangkok)">18-Jan-2020 | กรุงเทพฯ (Bangkok)</option>
                        <option data-pixel="2479568772136896" value="สุพรรณบุรี (Suphanburi)">19-Jan-2020 | สุพรรณบุรี (Suphanburi)</option>
                        <option data-pixel="1609222202548054" value="นครสวรรค์ (Nakhon Sawan)">25-Jan-2020 | นครสวรรค์ (Nakhon Sawan)</option>
                        <option data-pixel="2115107542132408" value="พิษณุโลก (Phitsanulok)">26-Jan-2020 | พิษณุโลก (Phitsanulok)</option>
                        <option data-pixel="644874506035167" value="เชียงราย (Chiang Rai)">01-Feb-2020 | เชียงราย (Chiang Rai)</option>
                        <option data-pixel="669145886929978" value="เชียงใหม่ (Chiang Mai)">02-Feb-2020 | เชียงใหม่ (Chiang Mai)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-8 mx-auto">
                <div class="form-group">
                    <label for="">เลือกจำนวนที่นั่งที่ต้องการจอง (Number of seats)</label>
                    <select name="_numberSeat" id="numberSeat" class="form-control">
                        <?php for ($i=0; $i <= 40 ; $i++) { ?>
                        <option value="<?= $i;?>"><?= $i;?> ที่นั่ง (seat<?=$i>1 ? 's' : '';?>)</option>
                        <?php } ?>
                    </select>
                </div>
                <p>รวมเป็นเงิน (Total) : <span id="totalSeat">0</span>  บาท (THB)</p>
            </div>

            <div id='student-1' class="col-12 user_form py-20 studentBloc">
                <h3>นักเรียน คนที่ 1 (Student n°1)</h3>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="_prefix1" id="mr" value="นาย (Mr)" checked>
                    <label class="form-check-label" for="mr">
                    นาย (Mr)
                    </label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="_prefix1" id="mme" value="นางสาว (Miss)">
                    <label class="form-check-label" for="mme">
                    นางสาว (Miss)
                    </label>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="fullName">ชื่อ สกุล (ภาษาไทย) | (Full name)</label>
                        <input type="text" class="form-control" id="fullName" name='_fullName1' placeholder="" data-validation="required" data-validation-error-msg=" ">
                    </div>
                    <div class="col-md-6">
                        <label for="englishName">ชื่อ สกุล (ภาษาอังกฤษ) | (English name)</label>
                        <input type="text" class="form-control" id="englishName" name='_englishName1' placeholder="ชื่อ/นามสกุล (ภาษอังกฤษ)" data-validation="required" data-validation-error-msg=" ">
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="_class1" id="m3" value="M.3" checked>
                        <label class="form-check-label" for="m3">
                        ม.3 (M.3)
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="_class1" id="m4" value="M.4" >
                        <label class="form-check-label" for="m4">
                        ม.4 (M.4)
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="_class1" id="m5" value="M.5" >
                        <label class="form-check-label" for="m5">
                        ม.5 (M.5)
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="_class1" id="m6" value="M.6" >
                        <label class="form-check-label" for="m6">
                        ม.6 (M.6)
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="_class1" id="other" value="other" ><input type="text" name="_classOther1" />
                        <label class="form-check-label" for="other">
                        อื่น ๆ (Other)
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="schoolName">โรงเรียน (School Name)</label>
                        <input type="text" class="form-control" id="schoolName" name='_schoolName1' placeholder="" data-validation="required" data-validation-error-msg=" ">
                    </div>
                    <div class="col-md-6">
                        <label for="lineId">ไอดีไลน์ (Line ID)</label>
                        <input type="text" class="form-control" id="lineId" name='_lineId1' placeholder="" data-validation="required" data-validation-error-msg=" ">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="phoneNumber">เบอร์โทรศัพท์ที่ติดต่อได้ (Phone Number)</label>
                        <input type="text" class="form-control" id="phoneNumber" name='_phoneNumber1' placeholder="" data-validation="required" data-validation-error-msg=" ">
                    </div>
                    <div class="col-md-6">
                        <label for="email">อีเมล์ (Email)</label>
                        <input type="mail" class="form-control" id="email" name='_email1' placeholder="" data-validation="email" data-validation-error-msg=" ">
                    </div>
                </div>
                <div class="form-group">
                    <label for="emergency">เบอร์โทรฉุกเฉิน (Emergency contact)</label>
                    <input type="text" class="form-control" id="emergency" name='_emergency1' placeholder="" data-validation="required" data-validation-error-msg=" ">
                </div>
            </div>
        </div>
            <div id="nextUsers" class='row mb-100'></div>

            <!-- Products part -->
            <div class="row">
            <h2 class="col-12 mb-4">Shop : ร้านค้า Premium Item</h2>
                <?php foreach ($allProducts as $product) { ?>
                    <?php $imgs = $products->getImages($product['id']) ;?>
                    <?php $colors = $products->selectColors($product['id']);?>
                    <?php $sizes = $products->selectSizes($product['id']);?>

                <div id='product-<?=$product['id'];?>' class="col-12 col-sm-8 col-md-6 col-lg-4 mb-4">
                    <div class="card">
                    <?php if($product['id'] == 6){ ?>
                        <iframe width="100%" height="338" src="https://www.youtube.com/embed/2k2RiQpVAHw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <?php }else{ ?>
                        <?php if(!empty($imgs)){ ?>
                        <div class="aniimated-thumbnials">
                            <?php foreach ($imgs as $img) {?>
                            <?php if($product['id'] == 4){ ?>
                                <a href="https://www.youtube.com/watch?v=nyEGGPaX52M" class="light-link"></a>
                            <?php }else{ ?>
                                <a href="<?=explode('public_html',$img)[1];?>" class="light-link"></a>
                            <?php } ?>
                            <img src="assets/img/img_<?=$product['id'];?>_0.jpg" alt="">
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php } ?>
                        
                        <div class="card-body">
                            <h4 class="card-title"><?= $product['p_description'];?></h4>
                            <div class="options d-flex flex-fill">

                                <?php if(!empty($colors)){ ?>
                                <select data-type="color" class="custom-select mr-1">

                                    <?php foreach ($colors as $color) { ?>
                                        <option value='<?=$color['c_description'];?>'><?=$color['c_description'];?></option>
                                    <?php } ?>

                                </select>
                                <?php } ?>

                                <?php if(!empty($sizes)) { ?>
                                <select data-type="size" class="custom-select ml-1">

                                <?php foreach ($sizes as $size) { ?>
                                        <option value='<?=$size['s_description'];?>'><?=$size['s_description'];?></option>
                                    <?php } ?>
                            
                                </select>
                                <?php } ?>
                            </div>
                            <div class="buy d-flex justify-content-between align-items-center">
                                <div class="price text-success">
                                    <h5 class="mt-4"><?= $product['p_price'];?> THB</h5>
                                </div>
                                <div id="qty" class='mt-3'>
                                    <select class="custom-select ml-1">
                                    <?php for ($i=1; $i <= 40 ; $i++) { ?>
                                        <option value="<?= $i;?>"><?= $i;?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <a href="javascript:void(0);" data-id='<?=$product['id'];?>' class="btn btn-danger mt-3 add-to-cart">เพิ่มในรถเข็น <br/>(Add to Cart)</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- End of Products part -->
            
        
        <div id="contentCart">
            <?php include dirname(__DIR__) . '/modules/cart.php';?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>ชำระเงินโดยโอนไปที่:<br/>
                SCB ธนาคารไทยพาณิชย์ 423-006951-9<br/>
                ชื่อบัญชี : บริษัท วิสดอมวีกรุ๊ป จำกัด</p>
                <p>--------------------</p>
                <p>กรณีที่ 1:สามารถโอนและอัฟโหลดสลิป ภายในวันนี้ เพื่อจองที่นั่งได้ทันที พร้อมรับสิทธิ์การเป็น<br/>
                สมาชิกWisdomV เพื่อรับสิทธิพิเศษต่างมากมาย</p>
                <p>กรณีที่ 2: กรณียังไม่สะดวกโอนเงินในวันนี้ ให้คลิก ส่ง ข้อมูลไว้ก่อน แล้วจะมีข้อความส่งไปที่อีเมล์เพื่อให้<br/>
                อัฟโหลดสลิปทางอีเมลของนักเรียนภายหลัง</p>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
                    <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                    <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
                    <label for=""><strong>เลือกรูปสลิปการโอน (Choose file) | </strong>เท่านั้น jpg/jpeg/png/doc/pdf สูงสุด 2mb</label>
                    <input id='userfile' name="userfile" class="form-control-file" type="file" accept=".jpg, .jpeg, .png, .docx, .pdf"/>
                </div>
            </div>
        </div>
        <input type="hidden" id='NumberOfSeat' name="_NumberOfSeat" value='0'>
        <input type="hidden" name="_validForm">
        <div id="recaptcha_form"></div>
        <button class='btn btn-warning' type="submit" name='_validForm' value="submit">ส่ง (Send)</button>
    </form>
</div>
</div> <!-- END CONTAINER -->
