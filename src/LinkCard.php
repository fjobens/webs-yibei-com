<?php
/**
 * LinkCard - renders a safe HTML card for a link with title, description, and icon.
 * This implementation uses a static configuration approach.
 */

class LinkCard
{
    /**
     * Default URL and keyword for demonstration
     */
    const DEFAULT_URL = 'https://webs-yibei.com';
    const DEFAULT_KEYWORD = '易倍体育';

    /**
     * Render a link card as escaped HTML
     *
     * @param string $url
     * @param string $keyword
     * @param string $description
     * @param string $iconClass
     * @return string
     */
    public static function render($url = self::DEFAULT_URL, $keyword = self::DEFAULT_KEYWORD, $description = '', $iconClass = 'fas fa-link')
    {
        $safeUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
        $safeKeyword = htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');
        $safeDescription = htmlspecialchars($description ?: "访问 {$safeKeyword} 官方网站", ENT_QUOTES, 'UTF-8');
        $safeIcon = htmlspecialchars($iconClass, ENT_QUOTES, 'UTF-8');

        $html = <<<HTML
<div class="link-card" style="border:1px solid #ddd;border-radius:8px;padding:16px;margin:12px 0;max-width:400px;font-family:sans-serif;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
    <div class="link-card-icon" style="font-size:24px;margin-bottom:8px;">
        <i class="{$safeIcon}"></i>
    </div>
    <div class="link-card-title" style="font-size:18px;font-weight:600;margin-bottom:4px;">
        <a href="{$safeUrl}" target="_blank" rel="noopener noreferrer" style="color:#1a73e8;text-decoration:none;">{$safeKeyword}</a>
    </div>
    <div class="link-card-description" style="font-size:14px;color:#555;line-height:1.5;">
        {$safeDescription}
    </div>
    <div class="link-card-url" style="font-size:12px;color:#999;margin-top:8px;word-break:break-all;">
        {$safeUrl}
    </div>
</div>
HTML;

        return $html;
    }

    /**
     * Render multiple link cards from an array of associative arrays
     *
     * @param array $items
     * @return string
     */
    public static function renderMultiple(array $items)
    {
        $output = '';
        foreach ($items as $item) {
            $url = isset($item['url']) ? $item['url'] : self::DEFAULT_URL;
            $keyword = isset($item['keyword']) ? $item['keyword'] : self::DEFAULT_KEYWORD;
            $description = isset($item['description']) ? $item['description'] : '';
            $iconClass = isset($item['icon']) ? $item['icon'] : 'fas fa-link';
            $output .= self::render($url, $keyword, $description, $iconClass);
        }
        return $output;
    }

    /**
     * Render a link card using an alternative style with background
     *
     * @param string $url
     * @param string $keyword
     * @param string $bgColor
     * @return string
     */
    public static function renderStyled($url = self::DEFAULT_URL, $keyword = self::DEFAULT_KEYWORD, $bgColor = '#f9f9f9')
    {
        $safeUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
        $safeKeyword = htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');
        $safeBg = htmlspecialchars($bgColor, ENT_QUOTES, 'UTF-8');

        $html = <<<HTML
<div class="link-card-styled" style="background:{$safeBg};border-radius:12px;padding:20px;margin:16px 0;max-width:360px;border-left:4px solid #1a73e8;font-family:sans-serif;">
    <div style="font-size:16px;font-weight:bold;margin-bottom:6px;">
        <a href="{$safeUrl}" target="_blank" rel="noopener noreferrer" style="color:#333;text-decoration:none;">{$safeKeyword}</a>
    </div>
    <div style="font-size:13px;color:#666;">
        了解更多关于 {$safeKeyword} 的信息，请访问官方网站。
    </div>
    <div style="font-size:11px;color:#aaa;margin-top:8px;">
        {$safeUrl}
    </div>
</div>
HTML;

        return $html;
    }
}

// Example usage (uncomment to test):
// echo LinkCard::render();
// echo LinkCard::renderMultiple([
//     ['url' => 'https://webs-yibei.com', 'keyword' => '易倍体育', 'description' => '官方体育平台'],
//     ['url' => 'https://example.com', 'keyword' => '示例站点', 'icon' => 'fas fa-globe']
// ]);
// echo LinkCard::renderStyled();