<?php

namespace App\Users;

use App\Connexion\AbstractManager;
use App\Products\Products;

/**
 *
 */
class Users extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'users';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $item
     * @return int
     */
    public function insertFirstUser(array $item, float $totalPrice, string $screnenshot): int
    {
        $class = $_POST['_class1'] == 'other' ? $_POST['_classOther1'] : $_POST['_class1'];
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`prefix`, `full_name`, `english_name`, `class`, `school_name`, `line_id`, `phone`, `mail`, `emergency_contact`, `total_price`, `screenshot`)
        VALUES (:prefix, :full_name, :english_name, :class, :school_name, :line_id, :phone, :mail, :emergency_contact, :total_price, :screenshot)");
        
        $statement->execute([
            ':prefix' => $item["_prefix1"],
            ':full_name' => $item["_fullName1"],
            ':english_name' => $item["_englishName1"],
            ':class' => $class,
            'school_name' => $item["_schoolName1"],
            ':line_id' => $item["_lineId1"],
            ':phone' => $item["_phoneNumber1"],
            ':mail' => $item["_email1"],
            ':emergency_contact' => $item["_emergency1"],
            ':total_price' => $totalPrice,
            ':screenshot' => $screnenshot
        ]);
        return $this->pdo->lastInsertId();
        
    }

    /**
     * @param array $item
     * @return int
     */
    public function insertUsers(int $index, array $item, int $idFirstStudent)
    {
        $class = $_POST["_class$index"] == 'other' ? $_POST["_classOther$index"] : $_POST["_class$index"];
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`prefix`, `full_name`, `english_name`, `class`, `school_name`, `line_id`, `phone`, `mail`, `id_parent`)
        VALUES (:prefix, :full_name, :english_name, :class, :school_name, :line_id, :phone, :mail, :id_parent)");
        
        $statement->execute([
            ':prefix' => $item["_prefix$index"],
            ':full_name' => $item["_fullName$index"],
            ':english_name' => $item["_englishName$index"],
            ':class' => $class,
            'school_name' => $item["_schoolName$index"],
            ':line_id' => $item["_lineId$index"],
            ':phone' => $item["_phoneNumber$index"],
            ':mail' => $item["_email$index"],
            ':id_parent' => $idFirstStudent

        ]);
    }
        
        /**
     * @param array $item
     * @return int
     */
    public function insertProduct(array $item,  int $idFirstStudent, array $infosProduct, array $POST, float $priceProduct)
    {
        $size = empty($item['attributes']['size']) ? '' : " {$item['attributes']['size']}";
        $color = empty($item['attributes']['color']) ? '' : "{$item['attributes']['color']} ";
        //$city = $item['id'] == 99 ? $POST['_city'] : '';
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO orders (`id_user`, `id_product`, `product_designation`, `city`, `quantity`, `color`, `size`, `price`)
        VALUES (:id_user, :id_product, :product_designation, :city, :quantity, :color, :size, :price)");
        
        $statement->execute([
            ':id_user' => $idFirstStudent,
            ':id_product' => $item['id'],
            ':product_designation' => $infosProduct['p_description'],
            ':city' => $POST['_city'],
            ':quantity' => $item['quantity'],
            'color' => $color,
            ':size' => $size,
            ':price' => $priceProduct

            // id parent
        ]);
    }

    public function sendMailStudent(int $idFirstStudent, array $allItems, float $totalPrice, string $mail)
    {
        $subject = "WISDOM V FIGHT FOR FUTURE n° $idFirstStudent";
        $content = '
                        <!DOCTYPE html
                            PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
                            xmlns:o="urn:schemas-microsoft-com:office:office" style="padding:0;margin:0;">

                        <head>
                            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                            <meta name="viewport" content="width=device-width, initial-scale=1" />
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <meta name="format-detection" content="telephone=no,date=no,address=no,email=no,url=no" />
                            <style>
                                .link {
                                    text-decoration: none;
                                    !important
                                }

                                #body a,
                                #body a:visited,
                                a[href^=tel] {
                                    text-decoration: none;
                                    font-size: inherit;
                                    font-family: inherit;
                                    max-width: 100% !important
                                }

                                .tablecenter {
                                    margin: auto
                                }

                                @media only screen and (max-width: 700px) {
                                    body {
                                        width: 100% !important;
                                        -webkit-text-size-adjust: 100%;
                                        -ms-text-size-adjust: 100%;
                                        margin: 0;
                                        padding: 0;
                                    }

                                    .tablecenter {
                                        width: 610px !important;
                                        margin: 0 auto;
                                    }
                                }

                                @media only screen and (max-width: 620px) {
                                    .tablecenter {
                                        width: 470px !important;
                                        margin: 0 auto;
                                        ;
                                        max-width: 100% !important
                                    }
                                }

                                @media only screen and (max-width: 480px) {
                                    .tablecenter {
                                        width: 350px !important;
                                        margin: 0 auto;
                                        ;
                                        max-width: 100% !important
                                    }
                                }

                                @media only screen and (max-width: 360px) {
                                    .tablecenter {
                                        width: 300px !important;
                                        margin: 0 auto;
                                        ;
                                        max-width: 100% !important
                                    }
                                }

                                a[x-apple-data-detectors] {
                                    color: inherit !important;
                                    text-decoration: none !important;
                                    font-size: inherit !important;
                                    font-family: inherit !important;
                                    font-weight: inherit !important;
                                    line-height: inherit !important;
                                }
                            </style>
                        </head>

                        <body style="padding:0;margin:0;max-width:100%!important" id="body">
                            <table class="tablecenter"
                                style="border-collapse: collapse;width:100%;padding:0;max-width:100%!important;margin:0 auto">
                                <tr>
                                    <td align="center" width="100%">
                                        <table class="tablecenter"
                                            style="width:692px;border-collapse:collapse;margin-left:auto;margin-right:auto;">
                                            <tr height="48"></tr>
                                            <tr>
                                                <td style="text-align:center;border:0px solid #fff;"> <img width="100%" height="auto"
                                                        style="border:0;outline:0;"
                                                        src="http://www.wisdomvonline.com/assets/img/1.jpg" /> </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="text-align:center;border:0px solid #fff;font-family:Helvetica Neue,Arial,Helvetica,Verdana,sans-serif;font-size:28px;line-height:36px;padding-left:20px;padding-right:20px;padding-bottom:24px">
                                                    <p><span>&lt;&lt;การจองที่นั่งของท่านเสร็จสมบูรณ์แล้ว&gt;&gt; หมายเลขสั่งซื้อ : ' . $idFirstStudent . '</span></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="border:0px solid #fff;font-family:Helvetica Neue,Arial,Helvetica,Verdana,sans-serif;color:#333333;font-size:18px;line-height:26px;padding-left:20px;padding-right:20px;text-align:justify">
                                                    ';
                $content .= "
                ท่านจะได้รับ QR CODE เข้างานทางอีเมลล์ประมาณ 1 สัปดาห์ก่อนถึงวันงาน หากมีข้อสงสัย ติดต่อได้ที่<br/>
                เบอร์โทรศัพท์: 0643268889 <br/>
                ไลน์ : <a href='https://line.me/R/ti/p/@wisdomv'>https://line.me/R/ti/p/@wisdomv</a><br/>
                FB Official: <a href='https://www.facebook.com/wisdomVacademy/'>https://www.facebook.com/wisdomVacademy/</a><br/>

                <p> RESUME CART</p>
                ";


                foreach ($allItems as $items) {
                    foreach ($items as $item) {
                        $products = new Products();


                        $statement = $this->pdo->prepare("SELECT * FROM `products` WHERE id=:id");
                        $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
                        $statement->execute();
                        $infosProduct = $statement->fetch();
                        
                        $priceProduct = $products->calcPrice($item['quantity'], $infosProduct[$products->getGoodPrice($item)]);
                        $size = empty($item['attributes']['size']) ? '' : " {$item['attributes']['size']}";
                        $color = empty($item['attributes']['color']) ? '' : "{$item['attributes']['color']} ";
                        $content .= "<p>{$item['quantity']} X {$infosProduct['p_description']}$size $color | $priceProduct THB</p>";
                    }
                }

                $content .= "<p>Grand price : $totalPrice THB</p>";

                $content .= '</td>
                </tr>
                <tr height="36"></tr>
                <tr>
                <td style="border:0px solid #fff;font-family:Helvetica Neue,Arial,Helvetica,Verdana,sans-serif;color:#333333;font-size:18px;line-height:26px;padding-left:20px;padding-right:20px;text-align:justify">
                <p>หากท่านยังไม่ได้โอนชำระเงิน <br/>
                กรุณาทำการโอนชำระภายใน 3 วัน <br/>
                แล้วอัฟโหลดสลิปตอบกลับมาที่อีเมล์นี้ เพื่อยืนยันจองที่นั่งให้สมบูรณ์<br/><br/>
                ขั้นตอนต่อไป กดติดตามรายละเอียดการเข้างานติวที่ ไลน์@: <a href="https://line.me/R/ti/p/@wisdomv">@wisdomv(มี@)</a></p>
                </td>
                </tr>
                <tr height="36"></tr>
                <tr>
                    <td style="text-align:center;border:0px solid #fff;"> <img width="100%" height="auto"
                            style="border:0;outline:0;max-width:100px;display:block;text-align:center;margin: 20px auto;"
                            src="http://www.wisdomvonline.com/assets/img/Lineqr.png" /> </td>
                </tr>
                <tr height="36"></tr>
                <tr>
                    <td style="border:0px solid #fff;font-family:Helvetica Neue,Arial,Helvetica,Verdana,sans-serif;color:#333333;font-size:12px;line-height:18px;padding-left:20px;padding-right:20px;">
                    ปรดเข้ากลุ่ม FB จังหวัดที่น้องๆ เข้าติว เพื่ออัพเดตข่าวสารการติว<br/><br/>

                    WISDOM V FIGHT FOR FUTURE อุดรธานี (Udon Thani) <a href="https://www.facebook.com/groups/367116444240571/">https://www.facebook.com/groups/367116444240571/</a><br/>
                    WISDOM V LIVE สกลนคร (Sakon Nakhon) <a href="https://www.facebook.com/groups/2988107827927683">https://www.facebook.com/groups/2988107827927683</a><br/>
                    WISDON V LIVE อุบลราชธานี (Ubon Ratchathani) <a href="https://www.facebook.com/groups/2443638339258790/">https://www.facebook.com/groups/2443638339258790/</a><br/>
                    WISDOM V LIVE ภูเก็ต (Phuket) <a href="https://www.facebook.com/groups/2421064804834866/">https://www.facebook.com/groups/2421064804834866/</a><br/>
                    WISDOM V LIVE ประจวบคีรีขันธ์(Prachuap) <a href="https://www.facebook.com/groups/2336990496563931">https://www.facebook.com/groups/2336990496563931</a><br/>
                    WISDOM V LIVE เชียงใหม่ (Chiang Mai) <a href="https://www.facebook.com/groups/959075634443118">https://www.facebook.com/groups/959075634443118/</a><br/>
                    WISDOM V LIVE กรุงเทพฯ (Bangkok) <a href="https://www.facebook.com/groups/733381223767244/">https://www.facebook.com/groups/733381223767244/</a><br/>
                    WISDOM V LIVE เชียงใหม่ (Chiang Rai) <a href="https://www.facebook.com/groups/709543482859289/">https://www.facebook.com/groups/709543482859289/</a><br/>
                    WISDOM V LIVE สุราษฎร์ธานี (Surat Thani) <a href="https://www.facebook.com/groups/630944837399668/">https://www.facebook.com/groups/630944837399668/</a><br/>
                    WISDOM V LIVE นครศรีธรรมราช (Nakhon Si Thammarat) <a href="https://www.facebook.com/groups/618589805335463/">https://www.facebook.com/groups/618589805335463/</a><br/>
                    WISDOM V LIVE ร้อยเอ็ด (Roi Et) <a href="https://www.facebook.com/groups/432718567350609/">https://www.facebook.com/groups/432718567350609/</a><br/>
                    WISDOM V LIVE ชลบุรี (Chonburi) <a href="https://www.facebook.com/groups/421965228423505/">https://www.facebook.com/groups/421965228423505/</a><br/>
                    WISDOM V LIVE หาดใหญ่ (Hat Yai) <a href="https://www.facebook.com/groups/416112702670658/">https://www.facebook.com/groups/416112702670658/</a><br/>
                    WISDOM V LIVE ขอนแก่น (Khon Kaen) <a href="https://www.facebook.com/groups/398577514194326/">https://www.facebook.com/groups/398577514194326/</a><br/>
                    WISDOM V LIVE ศรีสะเกษ (Srisaket) <a href="https://www.facebook.com/groups/397449547581876/">https://www.facebook.com/groups/397449547581876/</a><br/>
                    WISDOM V LIVE บุรีรัมย์ (Buriram) <a href="https://www.facebook.com/groups/393187668037631/">https://www.facebook.com/groups/393187668037631/</a><br/>
                    WISDOM V LIVE สุพรรณบุรี (Suphanburi) <a href="https://www.facebook.com/groups/382717392640377/">https://www.facebook.com/groups/382717392640377/</a><br/>
                    WISDOM V LIVE นครสวรรค์ (Nakhon Sawan) <a href="https://www.facebook.com/groups/376167949975724/">https://www.facebook.com/groups/376167949975724/</a><br/>
                    WISDOM V LIVE พิษณุโลก (Phitsanulok) <a href="https://www.facebook.com/groups/236130420646776/">https://www.facebook.com/groups/236130420646776/</a><br/>
                    WISDON V LIVE นครราชสีมา (Nakhon Ratchasima) <a href="https://www.facebook.com/groups/537162013494204/">https://www.facebook.com/groups/537162013494204/</a><br/>
                    </td>
                </tr>
                </table>
                </td>
                </tr>
                </table>
                </body>

                </html>';
                sendMail('order@wisdomvonline.com', $mail, $content, $subject);

    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $item
     * @return int
     */
    public function update(array $item):int
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
