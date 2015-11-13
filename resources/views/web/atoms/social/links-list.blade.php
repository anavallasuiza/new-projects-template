<div class="at-social-links-list">
    <ul class="links-list">
        <li>
            <a href="{{ sprintf(config('selmark.twitter_share_url'), $itemRoute, $itemTitle) }}" target="_blank" class="twitter{{! empty($buttons) ? ' button' : ''}} ">
                <span class="accessibility-text">Twitter</span>
            </a>
        </li>

        <li>
            <a href="{{ sprintf(config('selmark.facebook_share_url'), $itemRoute) }}" target="_blank" class="facebook{{! empty($buttons) ? ' button' : ''}}">
                <span class="accessibility-text">Facebook</span>
            </a>
        </li>

        <li>
            <a href="{{ sprintf(config('selmark.gplus_share_url'), $itemRoute) }}" target="_blank" class="google{{! empty($buttons) ? ' button' : ''}}">
                <span class="accessibility-text">Google Plus</span>
            </a>
        </li>
    </ul>
</div>