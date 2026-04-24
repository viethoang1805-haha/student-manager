<?php
if (!defined('ABSPATH')) exit;

// add metabox
function sm_add_metabox() {
    add_meta_box(
        'sm_info',
        'Thông tin sinh viên',
        'sm_metabox_html',
        'sinh_vien'
    );
}
add_action('add_meta_boxes', 'sm_add_metabox');

// UI
function sm_metabox_html($post) {
    wp_nonce_field('sm_save_data', 'sm_nonce');

    $mssv = get_post_meta($post->ID, 'mssv', true);
    $lop = get_post_meta($post->ID, 'lop', true);
    $ngaysinh = get_post_meta($post->ID, 'ngaysinh', true);
    ?>

    <p>
        MSSV: <input type="text" name="mssv" value="<?= esc_attr($mssv) ?>">
    </p>

    <p>
        Lớp:
        <select name="lop">
            <option value="CNTT" <?= selected($lop, 'CNTT') ?>>CNTT</option>
            <option value="Kinh tế" <?= selected($lop, 'Kinh tế') ?>>Kinh tế</option>
            <option value="Marketing" <?= selected($lop, 'Marketing') ?>>Marketing</option>
        </select>
    </p>

    <p>
        Ngày sinh:
        <input type="date" name="ngaysinh" value="<?= esc_attr($ngaysinh) ?>">
    </p>

    <?php
}

// save data
function sm_save_metabox($post_id) {

    // check nonce
    if (!isset($_POST['sm_nonce']) || !wp_verify_nonce($_POST['sm_nonce'], 'sm_save_data')) return;

    // tránh autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // sanitize
    $mssv = sanitize_text_field($_POST['mssv'] ?? '');
    $lop = sanitize_text_field($_POST['lop'] ?? '');
    $ngaysinh = sanitize_text_field($_POST['ngaysinh'] ?? '');

    update_post_meta($post_id, 'mssv', $mssv);
    update_post_meta($post_id, 'lop', $lop);
    update_post_meta($post_id, 'ngaysinh', $ngaysinh);
}
add_action('save_post', 'sm_save_metabox');