<?php
/**
 * ==========================================================
 * MODULE WEDGET_TEST_4: BÁO THANH NIÊN FOOTER
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/wedget_test_4/test.php
 * Thiết kế chuẩn hình ảnh Báo Thanh Niên & Kết nối Database
 * Khu vực hiển thị: Phía trên Footer (Trang chủ, Trang danh sách, Trang chi tiết)
 * ==========================================================
 */

if (!function_exists('get_header')) {
    $wp_load_path = dirname(__DIR__, 4) . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once $wp_load_path;
    }
}

// Khởi chạy chế độ test độc lập nếu được mở trực tiếp
$widget4_is_standalone = !did_action('get_header');
if ($widget4_is_standalone && function_exists('get_header')) {
    get_header();
}

// Nạp lớp xử lý Database
require_once __DIR__ . '/class-thanhnien-db.php';
$footer_db = new ThanhNien_Footer_DB();
$footer_db->create_table(); // Đảm bảo bảng và dữ liệu mẫu đã sẵn sàng trong DB
$d = $footer_db->get_all();
?>

<!-- ĐỊNH KIỂU CSS CHO MODULE WEDGET_TEST_4 (BÁO THANH NIÊN FOOTER) -->
<style>
    .thanhnien-footer-module {
        background-color: #ffffff;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        padding: 26px 0 32px 0;
        margin: 30px 0 0 0;
        color: #334155;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        font-size: 13.5px;
        width: 100%;
        box-shadow: 0 1px 4px rgba(0,0,0,0.03);
    }

    .thanhnien-footer-module * {
        box-sizing: border-box;
    }

    .tn-module-container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* --- HÀNG TRÊN: LOGO, MENU, MẠNG XÃ HỘI --- */
    .tn-mod-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .tn-mod-brand {
        display: flex;
        flex-direction: column;
    }

    .tn-mod-logo-link {
        text-decoration: none !important;
        display: inline-block;
    }

    .tn-mod-logo-text {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
        font-size: 32px;
        font-weight: 900;
        color: #0067b8 !important;
        letter-spacing: -0.5px;
        line-height: 1;
        text-transform: uppercase;
        display: inline-block;
    }

    .tn-mod-tagline {
        font-size: 10px;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin: 4px 0 0 0;
    }

    .tn-mod-top-right {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
    }

    .tn-mod-links {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .tn-mod-nav-link {
        color: #1e293b !important;
        text-decoration: none !important;
        font-size: 13.5px;
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .tn-mod-nav-link:hover {
        color: #0067b8 !important;
    }

    .tn-mod-social-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .tn-mod-sep {
        color: #cbd5e1;
        font-size: 14px;
        margin: 0 4px;
    }

    .tn-mod-social-label {
        font-size: 13.5px;
        color: #64748b;
        white-space: nowrap;
    }

    .tn-mod-social-icons {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .tn-mod-social-btn {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        border: 1px solid #cbd5e1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #64748b !important;
        text-decoration: none !important;
        background: #ffffff;
        transition: all 0.2s ease;
    }

    .tn-mod-social-fb:hover {
        border-color: #1877f2;
        background: #1877f2;
        color: #ffffff !important;
    }

    .tn-mod-social-zalo:hover {
        border-color: #0068ff;
        background: #0068ff;
        color: #ffffff !important;
    }

    .tn-mod-social-yt:hover {
        border-color: #ff0000;
        background: #ff0000;
        color: #ffffff !important;
    }

    .tn-mod-zalo-txt {
        font-size: 8.5px;
        font-weight: 800;
        letter-spacing: -0.2px;
    }

    /* --- ĐƯỜNG KẺ PHÂN CÁCH --- */
    .tn-mod-divider {
        border: none;
        border-top: 1px solid #e2e8f0;
        margin: 16px 0 20px 0;
    }

    /* --- HÀNG DƯỚI: 3 CỘT THÔNG TIN --- */
    .tn-mod-bottom {
        display: grid;
        grid-template-columns: 1.1fr 1.9fr 2.4fr;
        gap: 28px;
        align-items: start;
    }

    /* Cột 1: Liên hệ */
    .tn-mod-col-contact {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .tn-mod-contact-block {
        display: flex;
        flex-direction: column;
    }

    .tn-mod-contact-title {
        font-size: 13.5px;
        color: #64748b;
        margin-bottom: 2px;
    }

    .tn-mod-phone-link {
        font-size: 16px;
        font-weight: 700;
        color: #0067b8 !important;
        text-decoration: none !important;
        transition: color 0.2s;
    }

    .tn-mod-phone-link:hover {
        color: #0369a1 !important;
        text-decoration: underline !important;
    }

    /* Cột 2: Ban Biên Tập */
    .tn-mod-col-editorial {
        display: flex;
        flex-direction: column;
    }

    .tn-mod-editorial-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .tn-mod-editorial-item {
        font-size: 13.5px;
        line-height: 1.65;
        margin-bottom: 4px;
        color: #334155;
    }

    .tn-mod-role {
        font-weight: 600;
        color: #475569;
    }

    .tn-mod-name {
        color: #1e293b;
    }

    /* Cột 3: Bản Quyền & NCSC */
    .tn-mod-col-legal {
        display: flex;
        flex-direction: column;
    }

    .tn-mod-license-text {
        font-size: 13px;
        line-height: 1.6;
        color: #64748b;
        margin-bottom: 12px;
    }

    /* Huy hiệu NCSC Tín Nhiệm Mạng */
    .tn-mod-ncsc-badge {
        display: inline-flex;
        align-items: center;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 5px 10px;
        background: #f8fafc;
        text-decoration: none !important;
        gap: 10px;
        width: fit-content;
        transition: all 0.2s ease;
    }

    .tn-mod-ncsc-badge:hover {
        border-color: #94a3b8;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .tn-mod-ncsc-left {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        border-right: 1px solid #e2e8f0;
        padding-right: 8px;
    }

    .tn-mod-ncsc-brand {
        font-size: 12.5px;
        font-weight: 900;
        color: #0f172a;
        letter-spacing: -0.3px;
        line-height: 1;
    }

    .tn-mod-ncsc-star {
        color: #dc2626;
        font-size: 10.5px;
        margin-left: 2px;
    }

    .tn-mod-ncsc-tag {
        background: #1d4ed8;
        color: #ffffff;
        font-size: 8px;
        font-weight: 700;
        padding: 1px 4px;
        border-radius: 3px;
        text-transform: uppercase;
        margin-top: 3px;
        line-height: 1.2;
    }

    .tn-mod-ncsc-right {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .tn-mod-ncsc-icon {
        color: #0067b8;
        flex-shrink: 0;
    }

    .tn-mod-ncsc-text {
        display: flex;
        flex-direction: column;
        line-height: 1.25;
    }

    .tn-mod-ncsc-sub1 {
        font-size: 9.5px;
        color: #64748b;
    }

    .tn-mod-ncsc-sub2 {
        font-size: 11px;
        font-weight: 800;
        color: #0067b8;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    /* --- RESPONSIVE DESIGN --- */
    @media (max-width: 992px) {
        .tn-mod-bottom {
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .tn-mod-col-legal {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 768px) {
        .tn-mod-top {
            flex-direction: column;
            align-items: flex-start;
            gap: 14px;
        }
        .tn-mod-top-right {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        .tn-mod-sep {
            display: none;
        }
        .tn-mod-bottom {
            grid-template-columns: 1fr;
            gap: 18px;
        }
    }
</style>

<!-- GIAO DIỆN KHỐI BÁO THANH NIÊN FOOTER (MODULE WEDGET_TEST_4) -->
<section class="thanhnien-footer-module" id="thanhnien-footer-module" aria-label="Chân trang Báo Thanh Niên">
    <div class="tn-module-container">

        <!-- ================= HÀNG TRÊN: LOGO, MENU & MẠNG XÃ HỘI ================= -->
        <div class="tn-mod-top">
            <!-- Khối thương hiệu Logo & Slogan -->
            <div class="tn-mod-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="tn-mod-logo-link" title="<?php echo esc_attr($d['logo_text']); ?>">
                    <span class="tn-mod-logo-text"><?php echo esc_html($d['logo_text']); ?></span>
                </a>
                <p class="tn-mod-tagline"><?php echo esc_html($d['tagline']); ?></p>
            </div>

            <!-- Khối Menu điều hướng & Mạng xã hội -->
            <div class="tn-mod-top-right">
                <nav class="tn-mod-links" aria-label="Thanh Niên Top Links">
                    <a href="<?php echo esc_url($d['nav_datbao']); ?>" class="tn-mod-nav-link" target="_blank" rel="noopener">Đặt báo</a>
                    <a href="<?php echo esc_url($d['nav_quangcao']); ?>" class="tn-mod-nav-link" target="_blank" rel="noopener">Quảng cáo</a>
                    <a href="<?php echo esc_url($d['nav_rss']); ?>" class="tn-mod-nav-link" target="_blank" rel="noopener">RSS</a>
                    <a href="<?php echo esc_url($d['nav_toasoan']); ?>" class="tn-mod-nav-link" target="_blank" rel="noopener">Tòa soạn</a>
                    <a href="<?php echo esc_url($d['nav_chinhsach']); ?>" class="tn-mod-nav-link" target="_blank" rel="noopener">Chính sách bảo mật</a>
                </nav>

                <div class="tn-mod-social-wrapper">
                    <span class="tn-mod-sep" aria-hidden="true">|</span>
                    <span class="tn-mod-social-label"><?php echo esc_html($d['social_label']); ?></span>
                    
                    <div class="tn-mod-social-icons">
                        <!-- Facebook Icon -->
                        <a href="<?php echo esc_url($d['social_facebook']); ?>" class="tn-mod-social-btn tn-mod-social-fb" target="_blank" rel="noopener" title="Facebook" aria-label="Facebook">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H7v-3h3V9.5C10 6.46 11.82 5 14.5 5c1.28 0 2.63.23 2.63.23v2.89h-1.48c-1.5 0-1.97.93-1.97 1.88V12h3.25l-.52 3h-2.73v6.8c4.56-.93 8-4.96 8-9.8z"/>
                            </svg>
                        </a>

                        <!-- Zalo Icon -->
                        <a href="<?php echo esc_url($d['social_zalo']); ?>" class="tn-mod-social-btn tn-mod-social-zalo" target="_blank" rel="noopener" title="Zalo" aria-label="Zalo">
                            <span class="tn-mod-zalo-txt">Zalo</span>
                        </a>

                        <!-- YouTube Icon -->
                        <a href="<?php echo esc_url($d['social_youtube']); ?>" class="tn-mod-social-btn tn-mod-social-yt" target="_blank" rel="noopener" title="YouTube" aria-label="YouTube">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M21.58 7.19a2.5 2.5 0 0 0-1.76-1.77C18.26 5 12 5 12 5s-6.26 0-7.82.42A2.5 2.5 0 0 0 2.42 7.19C2 8.75 2 12 2 12s0 3.25.42 4.81a2.5 2.5 0 0 0 1.76 1.77c1.56.42 7.82.42 7.82.42s6.26 0 7.82-.42a2.5 2.5 0 0 0 1.76-1.77C22 15.25 22 12 22 12s0-3.25-.42-4.81zM10 15V9l5.2 3-5.2 3z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= ĐƯỜNG KẺ PHÂN CÁCH ================= -->
        <hr class="tn-mod-divider" />

        <!-- ================= HÀNG DƯỚI: THÔNG TIN CHI TIẾT 3 CỘT ================= -->
        <div class="tn-mod-bottom">
            
            <!-- Cột 1: Hotline & Quảng cáo -->
            <div class="tn-mod-col tn-mod-col-contact">
                <div class="tn-mod-contact-block">
                    <span class="tn-mod-contact-title"><?php echo esc_html($d['hotline_title']); ?></span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $d['hotline_number'])); ?>" class="tn-mod-phone-link">
                        <?php echo esc_html($d['hotline_number']); ?>
                    </a>
                </div>
                <div class="tn-mod-contact-block">
                    <span class="tn-mod-contact-title"><?php echo esc_html($d['ad_contact_title']); ?></span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $d['ad_contact_number'])); ?>" class="tn-mod-phone-link">
                        <?php echo esc_html($d['ad_contact_number']); ?>
                    </a>
                </div>
            </div>

            <!-- Cột 2: Ban Biên Tập -->
            <div class="tn-mod-col tn-mod-col-editorial">
                <ul class="tn-mod-editorial-list">
                    <?php for ($i = 1; $i <= 5; $i++): 
                        $key = 'editorial_title_' . $i;
                        if (!empty($d[$key])):
                            $parts = explode(':', $d[$key], 2);
                    ?>
                        <li class="tn-mod-editorial-item">
                            <?php if (count($parts) === 2): ?>
                                <strong class="tn-mod-role"><?php echo esc_html(trim($parts[0])); ?>:</strong>
                                <span class="tn-mod-name"><?php echo esc_html(trim($parts[1])); ?></span>
                            <?php else: ?>
                                <span><?php echo esc_html($d[$key]); ?></span>
                            <?php endif; ?>
                        </li>
                    <?php 
                        endif;
                    endfor; ?>
                </ul>
            </div>

            <!-- Cột 3: Giấy phép & Chứng nhận NCSC -->
            <div class="tn-mod-col tn-mod-col-legal">
                <p class="tn-mod-license-text">
                    <?php echo nl2br(esc_html($d['license_info'])); ?>
                </p>

                <!-- Huy hiệu NCSC Tín Nhiệm Mạng -->
                <a href="<?php echo esc_url($d['ncsc_badge_link']); ?>" target="_blank" rel="noopener" class="tn-mod-ncsc-badge" title="<?php echo esc_attr($d['ncsc_badge_sub']); ?>">
                    <div class="tn-mod-ncsc-left">
                        <span class="tn-mod-ncsc-brand">NCSC<span class="tn-mod-ncsc-star">★</span></span>
                        <span class="tn-mod-ncsc-tag"><?php echo esc_html($d['ncsc_badge_title']); ?></span>
                    </div>
                    <div class="tn-mod-ncsc-right">
                        <svg class="tn-mod-ncsc-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                        <div class="tn-mod-ncsc-text">
                            <span class="tn-mod-ncsc-sub1">Website đạt chứng nhận</span>
                            <strong class="tn-mod-ncsc-sub2">TÍN NHIỆM MẠNG</strong>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>

<?php
if ($widget4_is_standalone && function_exists('get_footer')) {
    get_footer();
}
?>
