<a href="add_player.php" class="add-member">إضافة عضو جديد</a>

<table>
            <thead>
                <tr>
                    <th>رقم العضو</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>المركز المفضل</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <!-- البيانات سيتم جلبها من قاعدة البيانات -->
                <?php
                // الاتصال بقاعدة البيانات
                $dsn = 'mysql:host=localhost;dbname=esd';
                $user = 'root';
                $pass = '';

                try {
                    $pdo = new PDO($dsn, $user, $pass);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // جلب جميع الأعضاء من قاعدة البيانات
                    $stmt = $pdo->query("SELECT * FROM players");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['player_id'] . "</td>";
                        echo "<td>" . $row['ferstname'] .' '. $row['lastname'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['place'] . "</td>";
                        echo "<td class='action-buttons'>
                                <a href='edit_member.php?id=" . $row['player_id'] . "' class='edit-btn'>تعديل</a>
                                <a href='delete_member.php?id=" . $row['player_id'] . "' class='delete-btn' onclick='return confirm(\"هل أنت متأكد من الحذف؟\");'>حذف</a>
                                <a href='view_member.php?id=" . $row['player_id'] . "' class='edit-btn'>تفاصيل</a>
                                </td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "فشل الاتصال بقاعدة البيانات: " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>