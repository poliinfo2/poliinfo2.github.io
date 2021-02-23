#!/bin/bash

set -xeu

# wget -m -np https://poliinfo2.net/ || true
cd poliinfo2.net
# wget -P control-panel/wp-content/plugins https://downloads.wordpress.org/plugin/pdf-embedder.4.6.1.zip
# wget -P control-panel/wp-content/plugins https://downloads.wordpress.org/plugin/bogo.3.4.zip
# wget -P control-panel/wp-content/plugins https://downloads.wordpress.org/plugin/highlighting-code-block.1.2.7.zip

find . -name feed -type d -print0 | xargs -0 rm -r
rm -r wp-json en/wp-json robots.txt control-panel/wp-includes/wlwmanifest.xml control-panel/xmlrpc.php\?rsd index.html\?p\=* en/index.html\?p\=* old/index.html api

source <(find control-panel -name '*\?*' | perl -ne 'chomp; $s = $d = $_; $d =~ s#\?.*$##; printf qq(mv -i %s %s\n), quotemeta($s), quotemeta($d);')
source <(find old -name 'index.html\?*=1' | perl -ne 'chomp; $s = $d = $_; $d =~ s#index\.html\?version=([^"&]+)&([^"&]+)=1$#$1_$2.html#; printf qq(mv -i %s %s\n), quotemeta($s), quotemeta($d);')

diff -qr en/contact contact
diff -qr en/faq faq
diff -qr en/resources resources
rm -r en/contact en/faq en/resources
ln -s ../contact ../faq ../resources en/

mv -i contact contact.index.html
mkdir contact
mv -i contact.index.html contact/index.html

find . \( -name \*.html -o -name \*.php \) -type f -print0 | xargs -0 perl -w -0 -pi.orig \
  -e 'sub r { my $r = $_[0]; $r =~ s#\bhttps://poliinfo2.net(?=/)##g; return $r } ' \
  -e 's#\s*<link rel=["\x27](https://api.w.org/|alternate|canonical|EditURI|shortlink|wlwmanifest)["\x27][^>]*>##g; ' \
  -e 's#\s*<link rel=\x27dns-prefetch\x27 href=\x27//s.w.org\x27 />\s*<script type="text/javascript">[^>]+</script>\s*<style type="text/css">[^<>]+</style>##sg; ' \
  -e 's#\s*<div class="fb-like" [^>]*>[^<]*</div>##g; ' \
  -e 's#\s*<a href="https://twitter.com/share" [^>]*>ツイート</a><script>[^<]*</script>##g; ' \
  -e 's#(<(?:a\b|img\b|script\b|link rel=[\x27\"]stylesheet[\x27"]|form\b)[^>]+\b(?:href|src|action)=)(["\x27])https://poliinfo2.net(/[^"\x27<>]*\2)#$1$2$3#g; ' \
  -e 's#(<img\b[^>]*\bsrcset=)(["\x27])([^"\x27<>]*)(\2)#$1.$2.r($3).$4#eg; ' \
  -e 's#(<a\b[^>]*?) ?\bdata-saferedirecturl=(["\x27])[^"\x27<>]*\2#$1#g; ' \
  -e 's#(var pdfemb_trans = \{"worker_src":")https:\\/\\/poliinfo2.net(\\/[^"]+","cmap_url":")https:\\/\\/poliinfo2.net(\\/[^"]+")#$1$2$3#g; ' \
  -e 's#(<a rel="alternate"[^>]*\bhref=")/old/(")#$1\#$2#g; ' \
  -e 's#(<a href="/old/)\?version=([^"&]+)&([^"&]+)=1(">)#$1$2_$3.html$4#g; ' \
  -e 's#(<a class="btn btn-primary)(" href="/api/download/\?id=\d+" target="download">)#$1 disabled$2#g; ' \
  -e 's#<wbr />##g; '

find . -name \*.orig -print0 | xargs -0 rm

cd control-panel/wp-content/plugins
unzip -qo pdf-embedder.4.6.1.zip
unzip -qo bogo.3.4.zip
unzip -qo highlighting-code-block.1.2.7.zip
rm -f pdf-embedder.4.6.1.zip bogo.3.4.zip highlighting-code-block.1.2.7.zip

exit

