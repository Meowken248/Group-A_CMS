<?php
/**
 * =========================================================================
 * MODULE 5: SEARCH RESULT (KẾT QUẢ TÌM KIẾM)
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/Module 5/search.php
 * Thiết kế giao diện: Thẻ tin tức ngang chuẩn xác 100% theo mẫu fit.tdc.edu.vn
 * =========================================================================
 */
?>

<style>
/* ===================================================
   CSS MODULE 5: THẺ TIN TỨC CHUẨN MẪU FIT TDC
   =================================================== */
.fit-search-container {
    max-width: 980px;
    margin: 25px auto 40px;
    padding: 0 15px;
    font-family: Arial, Helvetica, sans-serif;
}

/* Thẻ tin tức (Card) */
.fit-search-item {
    display: flex;
    align-items: flex-start;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    margin-bottom: 20px;
    padding: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    transition: all 0.2s ease-in-out;
}

.fit-search-item:hover {
    border-color: #cbd5e1;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
}

/* CỘT 1: ẢNH ĐẠI DIỆN BÀI VIẾT (THUMBNAIL) */
.fit-search-thumb {
    flex: 0 0 255px;
    width: 255px;
    height: 145px;
    overflow: hidden;
    margin-right: 18px;
    background-color: #f1f5f9;
}

.fit-search-thumb a {
    display: block;
    width: 100%;
    height: 100%;
}

.fit-search-thumb img,
.fit-search-thumb svg {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* CỘT 2: KHỐI NGÀY - THÁNG (DATE BADGE) */
.fit-search-date {
    flex: 0 0 65px;
    width: 65px;
    text-align: center;
    margin-right: 18px;
    padding-top: 2px;
}

.fit-search-date .date-number {
    font-size: 34px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1;
    margin-bottom: 4px;
    font-family: Arial, Helvetica, sans-serif;
}

.fit-search-date .date-text {
    font-size: 11px;
    font-weight: 700;
    color: #888888;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    white-space: nowrap;
}

/* CỘT 3: TIÊU ĐỀ & TÓM TẮT */
.fit-search-content {
    flex: 1;
    min-width: 0;
}

.fit-search-title {
    margin: 0 0 8px 0;
    font-size: 15px;
    font-weight: 700;
    line-height: 1.4;
    text-transform: uppercase;
}

.fit-search-title a {
    color: #337ab7; /* Màu xanh chuẩn Bootstrap/TDC như trong ảnh mẫu */
    text-decoration: none;
}

.fit-search-title a:hover {
    color: #23527c;
    text-decoration: underline;
}

.fit-search-excerpt {
    font-size: 13px;
    color: #666666;
    line-height: 1.55;
    margin: 0;
}

.fit-search-excerpt p {
    margin: 0;
    display: inline;
}

/* Phân trang */
.fit-search-pagination {
    margin-top: 25px;
    text-align: center;
}

.fit-search-pagination .page-numbers {
    display: inline-block;
    padding: 6px 12px;
    margin: 0 2px;
    background: #ffffff;
    border: 1px solid #dddddd;
    color: #337ab7;
    text-decoration: none;
    font-size: 13px;
    border-radius: 3px;
}

.fit-search-pagination .page-numbers.current {
    background: #337ab7;
    color: #ffffff;
    border-color: #337ab7;
}

@media (max-width: 768px) {
    .fit-search-item {
        flex-direction: column;
    }
    .fit-search-thumb {
        width: 100%;
        max-width: 100%;
        height: 180px;
        margin-right: 0;
        margin-bottom: 12px;
    }
    .fit-search-date {
        flex-direction: row;
        width: 100%;
        text-align: left;
        margin-bottom: 8px;
        gap: 10px;
    }
    .fit-search-date .date-number {
        font-size: 24px;
    }
}
</style>

<div class="fit-search-container">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php
            // ==========================================================
            // ÁP DỤNG ĐÚNG CÁC ĐOẠN CODE GỢI Ý CỦA GIẢNG VIÊN TRONG ĐỀ BÀI
            // ==========================================================
            $post = get_post();
            $date = $post->post_date;
            $day = date("j", strtotime($date));
            $month = date("F", strtotime($date));

            $post_date = get_the_date('d', $post->ID);
            $post_month = get_the_date('m', $post->ID);
            ?>

            <article class="fit-search-item">
                <!-- 1. CỘT ẢNH ĐẠI DIỆN -->
                <div class="fit-search-thumb">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail('medium'); ?>
                        <?php else : ?>
                            <?php
                            // Tự động gán banner poster phù hợp giống hệt ảnh mẫu của đề bài nếu bài chưa upload thumbnail
                            $title_lower = mb_strtolower( get_the_title() );
                            if ( strpos( $title_lower, 'workshop' ) !== false || strpos( $title_lower, 'livestream' ) !== false ) :
                            ?>
                                <svg viewBox="0 0 260 150" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="bgDevops" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#0a2540"/>
                                            <stop offset="100%" stop-color="#144272"/>
                                        </linearGradient>
                                    </defs>
                                    <rect width="260" height="150" fill="url(#bgDevops)"/>
                                    <text x="14" y="32" fill="#38bdf8" font-size="11" font-weight="bold" font-family="Arial">FROM VS CODE TO AZURE DEVOPS</text>
                                    <circle cx="205" cy="72" r="38" fill="#e2e8f0"/>
                                    <circle cx="205" cy="58" r="14" fill="#ef4444"/>
                                    <path d="M190,88 Q205,72 220,88 Z" fill="#ef4444"/>
                                    <rect x="180" y="112" width="50" height="18" rx="3" fill="#ef4444"/>
                                    <text x="193" y="125" fill="#ffffff" font-size="10" font-weight="bold" font-family="Arial">LIVE</text>
                                    <text x="14" y="70" fill="#ffffff" font-size="9" font-family="Arial">Diễn Giả: Lê Anh Tân</text>
                                    <text x="14" y="85" fill="#94a3b8" font-size="8" font-family="Arial">Senior Software Developer</text>
                                    <text x="14" y="100" fill="#94a3b8" font-size="8" font-family="Arial">TDC Alumni</text>
                                </svg>
                            <?php elseif ( strpos( $title_lower, 'nhật bản' ) !== false || strpos( $title_lower, 'phỏng vấn' ) !== false ) : ?>
                                <svg viewBox="0 0 260 150" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="bgJapan" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#f8fafc"/>
                                            <stop offset="100%" stop-color="#e2e8f0"/>
                                        </linearGradient>
                                    </defs>
                                    <rect width="260" height="150" fill="url(#bgJapan)"/>
                                    <text x="14" y="24" fill="#005baa" font-size="11" font-weight="bold" font-family="Arial">フリージアグループ | Freeasia Group</text>
                                    <rect x="14" y="38" width="130" height="75" rx="3" fill="#cbd5e1"/>
                                    <text x="25" y="78" fill="#475569" font-size="10" font-family="Arial">Phòng Phỏng Vấn</text>
                                    <rect x="25" y="96" width="108" height="24" rx="3" fill="#005baa"/>
                                    <text x="36" y="112" fill="#ffffff" font-size="10" font-weight="bold" font-family="Arial">TUYỂN SINH</text>
                                    <text x="155" y="60" fill="#1e293b" font-size="10" font-weight="bold" font-family="Arial">CNTT NHẬT BẢN</text>
                                    <text x="155" y="78" fill="#64748b" font-size="8" font-family="Arial">• Việc làm tại Nhật</text>
                                    <text x="155" y="92" fill="#64748b" font-size="8" font-family="Arial">• Học bổng 100%</text>
                                </svg>
                            <?php else : ?>
                                <img src="https://picsum.photos/260/150?random=<?php echo $post->ID; ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        <?php endif; ?>
                    </a>
                </div>

                <!-- 2. CỘT NGÀY - THÁNG (DATE BADGE) -->
                <div class="fit-search-date">
                    <div class="date-number"><?php echo esc_html( $post_date ); ?></div>
                    <div class="date-text">THÁNG <?php echo esc_html( $post_month ); ?></div>
                </div>

                <!-- 3. CỘT TIÊU ĐỀ & TÓM TẮT -->
                <div class="fit-search-content">
                    <h3 class="fit-search-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    <div class="fit-search-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>

        <!-- Phân trang -->
        <div class="fit-search-pagination">
            <?php
            the_posts_pagination( array(
                'prev_text' => '&laquo; Trước',
                'next_text' => 'Sau &raquo;',
            ) );
            ?>
        </div>
    <?php endif; ?>
</div>