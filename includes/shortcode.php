<?php
if (!defined('ABSPATH')) exit;

function sm_student_shortcode() {

    $query = new WP_Query([
        'post_type' => 'sinh_vien',
        'posts_per_page' => -1
    ]);

    ob_start();

    echo '<div class="sm-wrapper">';
    echo '<h1 class="sm-title">Danh sách sinh viên</h1>';

    if ($query->have_posts()) {

        echo '<table class="sm-table">';
        
        echo '<thead>
                <tr>
                    <th>STT</th>
                    <th>MSSV</th>
                    <th>Họ tên</th>
                    <th>Lớp</th>
                    <th>Ngày sinh</th>
                </tr>
              </thead>';

        echo '<tbody>';

        $stt = 1;

        while ($query->have_posts()) {
            $query->the_post();

            $mssv = esc_html(get_post_meta(get_the_ID(), 'mssv', true));
            $lop = esc_html(get_post_meta(get_the_ID(), 'lop', true));
            $ngaysinh = esc_html(get_post_meta(get_the_ID(), 'ngaysinh', true));

            echo "<tr>
                    <td>{$stt}</td>
                    <td>{$mssv}</td>
                    <td>" . esc_html(get_the_title()) . "</td>
                    <td>{$lop}</td>
                    <td>{$ngaysinh}</td>
                  </tr>";

            $stt++;
        }

        echo '</tbody>';
        echo '</table>';

    } else {
        echo '<p>Không có sinh viên nào.</p>';
    }

    echo '</div>';

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('danh_sach_sinh_vien', 'sm_student_shortcode');