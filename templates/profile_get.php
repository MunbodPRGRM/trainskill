<section>
    <h1>ข้อมูลผู้ใช้</h1>
    <table>
        <div>
            <img src="profile_placeholder.png" alt="โปรไฟล์">
        </div>
        <tr>
            <th>ID ผู้ใช้</th>
            <td><?= $data['result']['user_id'] ?></td>
        </tr>
        <tr>
            <th>ชื่อผู้ใช้</th>
            <td><?= $data['result']['user_name'] ?></td>
        </tr>
        <tr>
            <th>อีเมล</th>
            <td><?= $data['result']['email'] ?></td>
        </tr>
        <tr>
            <th>เพศ</th>
            <td><?= $data['result']['gender'] ?></td>
        </tr>
        <tr>
            <th>วันเกิด</th>
            <td><?= $data['result']['birthday'] ?></td>
        </tr>
        <tr>
            <th>เบอร์โทรศัพท์</th>
            <td><?= $data['result']['phone_number'] ?></td>
        </tr>
    </table>
</section>