<?php
/**
 * @author Rémy M. Böhler
 */

namespace Statamic\Addons\Disqus;

use Statamic\Extend\Tags;

/**
 * Class DisqusTags
 * @package Statamic\Addons\Disqus
 */
class DisqusTags extends Tags
{
    /** @var string */
    private $site;

    public function init()
    {
        $this->site = $this->getConfig('site');
    }

    /**
     * The {{ disqus:comments id="uniqueid" }} tag
     *
     * @return string|array
     */
    public function comments()
    {
        $id = $this->getParam('id');
        $url = $this->context['permalink'];

        $code = '
            <div id="disqus_thread"></div>
            <script>
            var disqus_config = function () {
                this.page.url = \'' . addslashes($url) . '\';
                this.page.identifier = \'' . addslashes($id) . '\';
            };
            
            (function() { // DON\'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement(\'script\');
            s.src = \'//' . $this->site . '.disqus.com/embed.js\';
            s.setAttribute(\'data-timestamp\', +new Date());
            (d.head || d.body).appendChild(s);
            })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        ';

        return $code;
    }
}
