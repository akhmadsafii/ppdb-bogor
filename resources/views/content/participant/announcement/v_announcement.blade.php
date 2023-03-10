<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="csrf-token" content="kmzDmNKUO3LXOymKiuqIAzFc1D3fUjcQvYvpVf8K" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/demo/favicon.png">
    <title>Pengumuman</title>
    <link href="http://localhost:8000/asset/css/material-icons.css" rel="stylesheet" type="text/css">

    <link rel="preload" href="http://localhost:8000/asset/css/monosocialiconsfont.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.3/mediaelementplayer.min.css"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css"
        rel="stylesheet" type="text/css">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet" type="text/css">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="http://localhost:8000/asset/css/style.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="http://localhost:8000/asset/css/monosocialiconsfont.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.3/mediaelementplayer.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="http://localhost:8000/asset/css/style.css">
    </noscript>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" async></script>
    <style>
        .bg-custom {
            background-color: #007bc7;
        }

        .shadow-lg {
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
            border-radius: 5px
        }
    </style>
    <style>
        .bg-custom {
            background-color: #007bc7;
        }

        .swal-text {
            text-align: center;
        }

        .bg-image {
            /* width: 60px;
 height: 60px; */
            background-position: center center;
            background-repeat: no-repeat;
            /* background-size: auto 60px; */
        }
    </style>
    <link rel='stylesheet' type='text/css' property='stylesheet'
        href='//localhost:8000/_debugbar/assets/stylesheets?v=1676989262&theme=auto' data-turbolinks-eval='false'
        data-turbo-eval='false'>
    <script src='//localhost:8000/_debugbar/assets/javascript?v=1676989262' data-turbolinks-eval='false'
        data-turbo-eval='false'></script>
    <script data-turbo-eval="false">
        jQuery.noConflict(true);
    </script>
    <script>
        Sfdump = window.Sfdump || (function(doc) {
            var refStyle = doc.createElement('style'),
                rxEsc = /([.*+?^${}()|\[\]\/\\])/g,
                idRx = /\bsf-dump-\d+-ref[012]\w+\b/,
                keyHint = 0 <= navigator.platform.toUpperCase().indexOf('MAC') ? 'Cmd' : 'Ctrl',
                addEventListener = function(e, n, cb) {
                    e.addEventListener(n, cb, false);
                };
            refStyle.innerHTML =
                '.phpdebugbar pre.sf-dump .sf-dump-compact, .sf-dump-str-collapse .sf-dump-str-collapse, .sf-dump-str-expand .sf-dump-str-expand { display: none; }';
            doc.head.appendChild(refStyle);
            refStyle = doc.createElement('style');
            doc.head.appendChild(refStyle);
            if (!doc.addEventListener) {
                addEventListener = function(element, eventName, callback) {
                    element.attachEvent('on' + eventName, function(e) {
                        e.preventDefault = function() {
                            e.returnValue = false;
                        };
                        e.target = e.srcElement;
                        callback(e);
                    });
                };
            }

            function toggle(a, recursive) {
                var s = a.nextSibling || {},
                    oldClass = s.className,
                    arrow, newClass;
                if (/\bsf-dump-compact\b/.test(oldClass)) {
                    arrow = '▼';
                    newClass = 'sf-dump-expanded';
                } else if (/\bsf-dump-expanded\b/.test(oldClass)) {
                    arrow = '▶';
                    newClass = 'sf-dump-compact';
                } else {
                    return false;
                }
                if (doc.createEvent && s.dispatchEvent) {
                    var event = doc.createEvent('Event');
                    event.initEvent('sf-dump-expanded' === newClass ? 'sfbeforedumpexpand' : 'sfbeforedumpcollapse',
                        true, false);
                    s.dispatchEvent(event);
                }
                a.lastChild.innerHTML = arrow;
                s.className = s.className.replace(/\bsf-dump-(compact|expanded)\b/, newClass);
                if (recursive) {
                    try {
                        a = s.querySelectorAll('.' + oldClass);
                        for (s = 0; s < a.length; ++s) {
                            if (-1 == a[s].className.indexOf(newClass)) {
                                a[s].className = newClass;
                                a[s].previousSibling.lastChild.innerHTML = arrow;
                            }
                        }
                    } catch (e) {}
                }
                return true;
            };

            function collapse(a, recursive) {
                var s = a.nextSibling || {},
                    oldClass = s.className;
                if (/\bsf-dump-expanded\b/.test(oldClass)) {
                    toggle(a, recursive);
                    return true;
                }
                return false;
            };

            function expand(a, recursive) {
                var s = a.nextSibling || {},
                    oldClass = s.className;
                if (/\bsf-dump-compact\b/.test(oldClass)) {
                    toggle(a, recursive);
                    return true;
                }
                return false;
            };

            function collapseAll(root) {
                var a = root.querySelector('a.sf-dump-toggle');
                if (a) {
                    collapse(a, true);
                    expand(a);
                    return true;
                }
                return false;
            }

            function reveal(node) {
                var previous, parents = [];
                while ((node = node.parentNode || {}) && (previous = node.previousSibling) && 'A' === previous
                    .tagName) {
                    parents.push(previous);
                }
                if (0 !== parents.length) {
                    parents.forEach(function(parent) {
                        expand(parent);
                    });
                    return true;
                }
                return false;
            }

            function highlight(root, activeNode, nodes) {
                resetHighlightedNodes(root);
                Array.from(nodes || []).forEach(function(node) {
                    if (!/\bsf-dump-highlight\b/.test(node.className)) {
                        node.className = node.className + ' sf-dump-highlight';
                    }
                });
                if (!/\bsf-dump-highlight-active\b/.test(activeNode.className)) {
                    activeNode.className = activeNode.className + ' sf-dump-highlight-active';
                }
            }

            function resetHighlightedNodes(root) {
                Array.from(root.querySelectorAll(
                        '.sf-dump-str, .sf-dump-key, .sf-dump-public, .sf-dump-protected, .sf-dump-private'))
                    .forEach(function(strNode) {
                        strNode.className = strNode.className.replace(/\bsf-dump-highlight\b/, '');
                        strNode.className = strNode.className.replace(/\bsf-dump-highlight-active\b/, '');
                    });
            }
            return function(root, x) {
                root = doc.getElementById(root);
                var indentRx = new RegExp('^(' + (root.getAttribute('data-indent-pad') || ' ').replace(rxEsc,
                        '\\$1') + ')+', 'm'),
                    options = {
                        "maxDepth": 1,
                        "maxStringLength": 160,
                        "fileLinkFormat": false
                    },
                    elt = root.getElementsByTagName('A'),
                    len = elt.length,
                    i = 0,
                    s, h, t = [];
                while (i < len) t.push(elt[i++]);
                for (i in x) {
                    options[i] = x[i];
                }

                function a(e, f) {
                    addEventListener(root, e, function(e, n) {
                        if ('A' == e.target.tagName) {
                            f(e.target, e);
                        } else if ('A' == e.target.parentNode.tagName) {
                            f(e.target.parentNode, e);
                        } else {
                            n = /\bsf-dump-ellipsis\b/.test(e.target.className) ? e.target.parentNode :
                                e.target;
                            if ((n = n.nextElementSibling) && 'A' == n.tagName) {
                                if (!/\bsf-dump-toggle\b/.test(n.className)) {
                                    n = n.nextElementSibling || n;
                                }
                                f(n, e, true);
                            }
                        }
                    });
                };

                function isCtrlKey(e) {
                    return e.ctrlKey || e.metaKey;
                }

                function xpathString(str) {
                    var parts = str.match(/[^'"]+|['"]/g).map(function(part) {
                        if ("'" == part) {
                            return '"\'"';
                        }
                        if ('"' == part) {
                            return "'\"'";
                        }
                        return "'" + part + "'";
                    });
                    return "concat(" + parts.join(",") + ", '')";
                }

                function xpathHasClass(className) {
                    return "contains(concat(' ', normalize-space(@class), ' '), ' " + className + " ')";
                }
                addEventListener(root, 'mouseover', function(e) {
                    if ('' != refStyle.innerHTML) {
                        refStyle.innerHTML = '';
                    }
                });
                a('mouseover', function(a, e, c) {
                    if (c) {
                        e.target.style.cursor = "pointer";
                    } else if (a = idRx.exec(a.className)) {
                        try {
                            refStyle.innerHTML = '.phpdebugbar pre.sf-dump .' + a[0] +
                                '{background-color: #B729D9; color: #FFF !important; border-radius: 2px}';
                        } catch (e) {}
                    }
                });
                a('click', function(a, e, c) {
                    if (/\bsf-dump-toggle\b/.test(a.className)) {
                        e.preventDefault();
                        if (!toggle(a, isCtrlKey(e))) {
                            var r = doc.getElementById(a.getAttribute('href').slice(1)),
                                s = r.previousSibling,
                                f = r.parentNode,
                                t = a.parentNode;
                            t.replaceChild(r, a);
                            f.replaceChild(a, s);
                            t.insertBefore(s, r);
                            f = f.firstChild.nodeValue.match(indentRx);
                            t = t.firstChild.nodeValue.match(indentRx);
                            if (f && t && f[0] !== t[0]) {
                                r.innerHTML = r.innerHTML.replace(new RegExp('^' + f[0].replace(rxEsc,
                                    '\\$1'), 'mg'), t[0]);
                            }
                            if (/\bsf-dump-compact\b/.test(r.className)) {
                                toggle(s, isCtrlKey(e));
                            }
                        }
                        if (c) {} else if (doc.getSelection) {
                            try {
                                doc.getSelection().removeAllRanges();
                            } catch (e) {
                                doc.getSelection().empty();
                            }
                        } else {
                            doc.selection.empty();
                        }
                    } else if (/\bsf-dump-str-toggle\b/.test(a.className)) {
                        e.preventDefault();
                        e = a.parentNode.parentNode;
                        e.className = e.className.replace(/\bsf-dump-str-(expand|collapse)\b/, a
                            .parentNode.className);
                    }
                });
                elt = root.getElementsByTagName('SAMP');
                len = elt.length;
                i = 0;
                while (i < len) t.push(elt[i++]);
                len = t.length;
                for (i = 0; i < len; ++i) {
                    elt = t[i];
                    if ('SAMP' == elt.tagName) {
                        a = elt.previousSibling || {};
                        if ('A' != a.tagName) {
                            a = doc.createElement('A');
                            a.className = 'sf-dump-ref';
                            elt.parentNode.insertBefore(a, elt);
                        } else {
                            a.innerHTML += ' ';
                        }
                        a.title = (a.title ? a.title + '\n[' : '[') + keyHint + '+click] Expand all children';
                        a.innerHTML += elt.className == 'sf-dump-compact' ? '<span>▶</span>' : '<span>▼</span>';
                        a.className += ' sf-dump-toggle';
                        x = 1;
                        if ('sf-dump' != elt.parentNode.className) {
                            x += elt.parentNode.getAttribute('data-depth') / 1;
                        }
                    } else if (/\bsf-dump-ref\b/.test(elt.className) && (a = elt.getAttribute('href'))) {
                        a = a.slice(1);
                        elt.className += ' ' + a;
                        if (/[\[{]$/.test(elt.previousSibling.nodeValue)) {
                            a = a != elt.nextSibling.id && doc.getElementById(a);
                            try {
                                s = a.nextSibling;
                                elt.appendChild(a);
                                s.parentNode.insertBefore(a, s);
                                if (/^[@#]/.test(elt.innerHTML)) {
                                    elt.innerHTML += ' <span>▶</span>';
                                } else {
                                    elt.innerHTML = '<span>▶</span>';
                                    elt.className = 'sf-dump-ref';
                                }
                                elt.className += ' sf-dump-toggle';
                            } catch (e) {
                                if ('&' == elt.innerHTML.charAt(0)) {
                                    elt.innerHTML = '…';
                                    elt.className = 'sf-dump-ref';
                                }
                            }
                        }
                    }
                }
                if (doc.evaluate && Array.from && root.children.length > 1) {
                    root.setAttribute('tabindex', 0);
                    SearchState = function() {
                        this.nodes = [];
                        this.idx = 0;
                    };
                    SearchState.prototype = {
                        next: function() {
                            if (this.isEmpty()) {
                                return this.current();
                            }
                            this.idx = this.idx < (this.nodes.length - 1) ? this.idx + 1 : 0;
                            return this.current();
                        },
                        previous: function() {
                            if (this.isEmpty()) {
                                return this.current();
                            }
                            this.idx = this.idx > 0 ? this.idx - 1 : (this.nodes.length - 1);
                            return this.current();
                        },
                        isEmpty: function() {
                            return 0 === this.count();
                        },
                        current: function() {
                            if (this.isEmpty()) {
                                return null;
                            }
                            return this.nodes[this.idx];
                        },
                        reset: function() {
                            this.nodes = [];
                            this.idx = 0;
                        },
                        count: function() {
                            return this.nodes.length;
                        },
                    };

                    function showCurrent(state) {
                        var currentNode = state.current(),
                            currentRect, searchRect;
                        if (currentNode) {
                            reveal(currentNode);
                            highlight(root, currentNode, state.nodes);
                            if ('scrollIntoView' in currentNode) {
                                currentNode.scrollIntoView(true);
                                currentRect = currentNode.getBoundingClientRect();
                                searchRect = search.getBoundingClientRect();
                                if (currentRect.top < (searchRect.top + searchRect.height)) {
                                    window.scrollBy(0, -(searchRect.top + searchRect.height + 5));
                                }
                            }
                        }
                        counter.textContent = (state.isEmpty() ? 0 : state.idx + 1) + ' of ' + state.count();
                    }
                    var search = doc.createElement('div');
                    search.className = 'sf-dump-search-wrapper sf-dump-search-hidden';
                    search.innerHTML =
                        ' <input type="text" class="sf-dump-search-input"> <span class="sf-dump-search-count">0 of 0<\/span> <button type="button" class="sf-dump-search-input-previous" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 1331l-166 165q-19 19-45 19t-45-19L896 965l-531 531q-19 19-45 19t-45-19l-166-165q-19-19-19-45.5t19-45.5l742-741q19-19 45-19t45 19l742 741q19 19 19 45.5t-19 45.5z"\/><\/svg> <\/button> <button type="button" class="sf-dump-search-input-next" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 808l-742 741q-19 19-45 19t-45-19L109 808q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"\/><\/svg> <\/button> ';
                    root.insertBefore(search, root.firstChild);
                    var state = new SearchState();
                    var searchInput = search.querySelector('.sf-dump-search-input');
                    var counter = search.querySelector('.sf-dump-search-count');
                    var searchInputTimer = 0;
                    var previousSearchQuery = '';
                    addEventListener(searchInput, 'keyup', function(e) {
                        var searchQuery = e.target
                        .value; /* Don't perform anything if the pressed key didn't change the query */
                        if (searchQuery === previousSearchQuery) {
                            return;
                        }
                        previousSearchQuery = searchQuery;
                        clearTimeout(searchInputTimer);
                        searchInputTimer = setTimeout(function() {
                            state.reset();
                            collapseAll(root);
                            resetHighlightedNodes(root);
                            if ('' === searchQuery) {
                                counter.textContent = '0 of 0';
                                return;
                            }
                            var classMatches = ["sf-dump-str", "sf-dump-key", "sf-dump-public",
                                "sf-dump-protected", "sf-dump-private",
                            ].map(xpathHasClass).join(' or ');
                            var xpathResult = doc.evaluate('.//span[' + classMatches +
                                '][contains(translate(child::text(), ' + xpathString(
                                    searchQuery.toUpperCase()) + ', ' + xpathString(
                                    searchQuery.toLowerCase()) + '), ' + xpathString(
                                    searchQuery.toLowerCase()) + ')]', root, null,
                                XPathResult.ORDERED_NODE_ITERATOR_TYPE, null);
                            while (node = xpathResult.iterateNext()) state.nodes.push(node);
                            showCurrent(state);
                        }, 400);
                    });
                    Array.from(search.querySelectorAll(
                        '.sf-dump-search-input-next, .sf-dump-search-input-previous')).forEach(function(
                    btn) {
                        addEventListener(btn, 'click', function(e) {
                            e.preventDefault(); - 1 !== e.target.className.indexOf('next') ?
                                state.next() : state.previous();
                            searchInput.focus();
                            collapseAll(root);
                            showCurrent(state);
                        })
                    });
                    addEventListener(root, 'keydown', function(e) {
                        var isSearchActive = !/\bsf-dump-search-hidden\b/.test(search.className);
                        if ((114 === e.keyCode && !isSearchActive) || (isCtrlKey(e) && 70 === e
                            .keyCode)) {
                            /* F3 or CMD/CTRL + F */
                            if (70 === e.keyCode && document.activeElement === searchInput) {
                                /* * If CMD/CTRL + F is hit while having focus on search input, * the user probably meant to trigger browser search instead. * Let the browser execute its behavior: */
                                return;
                            }
                            e.preventDefault();
                            search.className = search.className.replace(/\bsf-dump-search-hidden\b/,
                            '');
                            searchInput.focus();
                        } else if (isSearchActive) {
                            if (27 === e.keyCode) {
                                /* ESC key */
                                search.className += ' sf-dump-search-hidden';
                                e.preventDefault();
                                resetHighlightedNodes(root);
                                searchInput.value = '';
                            } else if ((isCtrlKey(e) && 71 === e.keyCode) /* CMD/CTRL + G */ || 13 === e
                                .keyCode /* Enter */ || 114 === e.keyCode /* F3 */ ) {
                                e.preventDefault();
                                e.shiftKey ? state.previous() : state.next();
                                collapseAll(root);
                                showCurrent(state);
                            }
                        }
                    });
                }
                if (0 >= options.maxStringLength) {
                    return;
                }
                try {
                    elt = root.querySelectorAll('.sf-dump-str');
                    len = elt.length;
                    i = 0;
                    t = [];
                    while (i < len) t.push(elt[i++]);
                    len = t.length;
                    for (i = 0; i < len; ++i) {
                        elt = t[i];
                        s = elt.innerText || elt.textContent;
                        x = s.length - options.maxStringLength;
                        if (0 < x) {
                            h = elt.innerHTML;
                            elt[elt.innerText ? 'innerText' : 'textContent'] = s.substring(0, options
                                .maxStringLength);
                            elt.className += ' sf-dump-str-collapse';
                            elt.innerHTML = '<span class=sf-dump-str-collapse>' + h +
                                '<a class="sf-dump-ref sf-dump-str-toggle" title="Collapse"> ◀</a></span>' +
                                '<span class=sf-dump-str-expand>' + elt.innerHTML +
                                '<a class="sf-dump-ref sf-dump-str-toggle" title="' + x +
                                ' remaining characters"> ▶</a></span>';
                        }
                    }
                } catch (e) {}
            };
        })(document);
    </script>
    <style>
        .phpdebugbar pre.sf-dump {
            display: block;
            white-space: pre;
            padding: 5px;
            overflow: initial !important;
        }

        .phpdebugbar pre.sf-dump:after {
            content: "";
            visibility: hidden;
            display: block;
            height: 0;
            clear: both;
        }

        .phpdebugbar pre.sf-dump span {
            display: inline;
        }

        .phpdebugbar pre.sf-dump a {
            text-decoration: none;
            cursor: pointer;
            border: 0;
            outline: none;
            color: inherit;
        }

        .phpdebugbar pre.sf-dump img {
            max-width: 50em;
            max-height: 50em;
            margin: .5em 0 0 0;
            padding: 0;
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAAAAAA6mKC9AAAAHUlEQVQY02O8zAABilCaiQEN0EeA8QuUcX9g3QEAAjcC5piyhyEAAAAASUVORK5CYII=) #D3D3D3;
        }

        .phpdebugbar pre.sf-dump .sf-dump-ellipsis {
            display: inline-block;
            overflow: visible;
            text-overflow: ellipsis;
            max-width: 5em;
            white-space: nowrap;
            overflow: hidden;
            vertical-align: top;
        }

        .phpdebugbar pre.sf-dump .sf-dump-ellipsis+.sf-dump-ellipsis {
            max-width: none;
        }

        .phpdebugbar pre.sf-dump code {
            display: inline;
            padding: 0;
            background: none;
        }

        .sf-dump-public.sf-dump-highlight,
        .sf-dump-protected.sf-dump-highlight,
        .sf-dump-private.sf-dump-highlight,
        .sf-dump-str.sf-dump-highlight,
        .sf-dump-key.sf-dump-highlight {
            background: rgba(111, 172, 204, 0.3);
            border: 1px solid #7DA0B1;
            border-radius: 3px;
        }

        .sf-dump-public.sf-dump-highlight-active,
        .sf-dump-protected.sf-dump-highlight-active,
        .sf-dump-private.sf-dump-highlight-active,
        .sf-dump-str.sf-dump-highlight-active,
        .sf-dump-key.sf-dump-highlight-active {
            background: rgba(253, 175, 0, 0.4);
            border: 1px solid #ffa500;
            border-radius: 3px;
        }

        .phpdebugbar pre.sf-dump .sf-dump-search-hidden {
            display: none !important;
        }

        .phpdebugbar pre.sf-dump .sf-dump-search-wrapper {
            font-size: 0;
            white-space: nowrap;
            margin-bottom: 5px;
            display: flex;
            position: -webkit-sticky;
            position: sticky;
            top: 5px;
        }

        .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>* {
            vertical-align: top;
            box-sizing: border-box;
            height: 21px;
            font-weight: normal;
            border-radius: 0;
            background: #FFF;
            color: #757575;
            border: 1px solid #BBB;
        }

        .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>input.sf-dump-search-input {
            padding: 3px;
            height: 21px;
            font-size: 12px;
            border-right: none;
            border-top-left-radius: 3px;
            border-bottom-left-radius: 3px;
            color: #000;
            min-width: 15px;
            width: 100%;
        }

        .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>.sf-dump-search-input-next,
        .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>.sf-dump-search-input-previous {
            background: #F2F2F2;
            outline: none;
            border-left: none;
            font-size: 0;
            line-height: 0;
        }

        .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>.sf-dump-search-input-next {
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
        }

        .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>.sf-dump-search-input-next>svg,
        .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>.sf-dump-search-input-previous>svg {
            pointer-events: none;
            width: 12px;
            height: 12px;
        }

        .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>.sf-dump-search-count {
            display: inline-block;
            padding: 0 5px;
            margin: 0;
            border-left: none;
            line-height: 21px;
            font-size: 12px;
        }

        .phpdebugbar pre.sf-dump,
        .phpdebugbar pre.sf-dump .sf-dump-default {
            word-wrap: break-word;
            white-space: pre-wrap;
            word-break: normal
        }

        .phpdebugbar pre.sf-dump .sf-dump-num {
            font-weight: bold;
            color: #1299DA
        }

        .phpdebugbar pre.sf-dump .sf-dump-const {
            font-weight: bold
        }

        .phpdebugbar pre.sf-dump .sf-dump-str {
            font-weight: bold;
            color: #3A9B26
        }

        .phpdebugbar pre.sf-dump .sf-dump-note {
            color: #1299DA
        }

        .phpdebugbar pre.sf-dump .sf-dump-ref {
            color: #7B7B7B
        }

        .phpdebugbar pre.sf-dump .sf-dump-public {
            color: #000000
        }

        .phpdebugbar pre.sf-dump .sf-dump-protected {
            color: #000000
        }

        .phpdebugbar pre.sf-dump .sf-dump-private {
            color: #000000
        }

        .phpdebugbar pre.sf-dump .sf-dump-meta {
            color: #B729D9
        }

        .phpdebugbar pre.sf-dump .sf-dump-key {
            color: #3A9B26
        }

        .phpdebugbar pre.sf-dump .sf-dump-index {
            color: #1299DA
        }

        .phpdebugbar pre.sf-dump .sf-dump-ellipsis {
            color: #A0A000
        }

        .phpdebugbar pre.sf-dump .sf-dump-ns {
            user-select: none;
        }

        .phpdebugbar pre.sf-dump .sf-dump-ellipsis-note {
            color: #1299DA
        }
    </style>
</head>

<body class="header-centered sidebar-horizontal">
    <div id="wrapper" class="wrapper">
        <header>
            <style>
                @media (max-width: 960px) {
                    .navbar-header {
                        width: 150px !important;
                    }
                }
            </style>
            <nav class="navbar bg-custom">
                <div class="navbar-header">
                    <a href="http://localhost:8000" class="navbar-brand bg-custom text-center">
                        <img class="logo-expand mx-2" alt=""
                            src="https://myschbucket.s3.ap-southeast-1.amazonaws.com/logo/2023030811453052152.png"
                            height="80">
                        <img class="logo-collapse" alt=""
                            src="https://myschbucket.s3.ap-southeast-1.amazonaws.com/logo/2023030811453052152.png"
                            height="80">
                        <span class="text-white logo-expand">Teagan Hall</span>
                        <span class="text-white logo-collapse">Teagan Hall</span>
                    </a>
                </div>
                <ul class="nav navbar-nav" style="position: absolute; right: 0">
                    <li class="sidebar-toggle"><a href="javascript:void(0)" class="ripple"><i
                                class="material-icons list-icon">menu</i></a>
                    </li>
                </ul>
                <div class="spacer"></div>
            </nav>
            <aside class="site-sidebar x clearfix valign">
                <div class="nav-top ">
                    <nav class="sidebar-nav">
                        <ul class="nav in side-menu">
                            <li><a href="http://localhost:8000"><i class="material-icons list-icon">rss_feed</i><span
                                        class="hide-menu">Beranda</span></a></li>
                            <li class="menu-item-has-children"><a href="javascript:void(0);" class="ripple">
                                    <i class="material-icons list-icon">info</i>
                                    <span class="hide-menu">Informasi Pendaftaran</span></a>
                                <ul class="list-unstyled sub-menu collapse" aria-expanded="false">
                                    <li><a href="http://localhost:8000/information/plot">Alur Pendaftaran</a>
                                    </li>
                                    <li><a href="http://localhost:8000/information/requirement">Syarat Pendaftaran</a>
                                    </li>
                                    <li><a href="http://localhost:8000/information/guide">Panduan Pendaftaran</a>
                                    </li>
                                    <li><a href="http://localhost:8000/schedule">Rangkaian Kegiatan</a>
                                    </li>
                                    <li><a href="http://localhost:8000/information/faq">FAQ</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-item-has-children"><a href="javascript:void(0);" class="ripple">
                                    <i class="material-icons list-icon">feedback</i>
                                    <span class="hide-menu">Pengumuman</span></a>
                                <ul class="list-unstyled sub-menu collapse" aria-expanded="false">
                                    <li><a href="http://localhost:8000/announcement">Informasi</a>
                                    </li>
                                    <li><a href="http://localhost:8000/score">Nilai Siswa</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="http://localhost:8000/selection"><i
                                        class="material-icons list-icon">list</i><span class="hide-menu">Seleksi PPDB
                                    </span></a></li>

                            <li class="menu-item-has-children"><a href="javascript:void(0);" class="ripple">
                                    <i class="material-icons list-icon">cloud_download</i>
                                    <span class="hide-menu">Download</span></a>
                                <ul class="list-unstyled sub-menu collapse" aria-expanded="false">
                                    <li><a href="http://localhost:8000/download/file">File</a>
                                    </li>
                                    <li><a href="http://localhost:8000/download/brochure">Brosur</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="http://localhost:8000/auth/login"><i
                                        class="material-icons list-icon">arrow_forward</i><span
                                        class="hide-menu">Login</span></a></li>
                        </ul>
                    </nav>
                </div>
            </aside>
        </header>
        <div class="content-wrapper">
            <style>
                .heading-page {
                    /* background: url("https://d36ai2hkxl16us.cloudfront.net/thoughtindustries/image/upload/a_exif,c_fill,w_750,h_361/v1426633725/eq54w9myfn6xfd28p92g.jpg") no-repeat; */
                    background-position: center;
                    background-size: inherit;
                    background-attachment: fixed;
                    height: 361px;
                    position: relative;
                    text-align: center;
                }

                .heading-page::before {
                    content: "";
                    display: block;
                    filter: blur(1px) brightness(30%);
                    position: absolute;
                    left: 10px;
                    top: 10px;
                    right: 10px;
                    bottom: 10px;
                    background: inherit;
                    z-index: 0;
                }

                .content {
                    position: relative;
                    z-index: 8;
                }

                .title {
                    font-family: arial;
                    font-size: 3em;
                    font-weight: 900;
                }

                .text {
                    font-family: arial;
                    font-size: 2em;
                    font-weight: 100;
                    display: inline-block;
                    width: 40%;
                }
            </style>

            <section class="heading-page header-text" id="top"
                style="background-image: url(https://myschbucket.s3.ap-southeast-1.amazonaws.com/thumb/ppdb/image/banner/20230309112943.jpg?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&amp;X-Amz-Algorithm=AWS4-HMAC-SHA256&amp;X-Amz-Credential=AKIA6PMWFSFW74V33OEG%2F20230310%2Fap-southeast-1%2Fs3%2Faws4_request&amp;X-Amz-Date=20230310T043218Z&amp;X-Amz-SignedHeaders=host&amp;X-Amz-Expires=120&amp;X-Amz-Signature=930ba4a16c160aa70bbbe40b7bcc97095448e4f9006a3d132b1043fe7a298208)">
                <div class='container'>
                    <div class="content pt-5">
                        <div class="text pt-5 pb-0 text-white">Kategori</div>
                        <div class="title text-yellow">Pengumuman</div>
                    </div>
                </div>
            </section>
            <main class="main-wrapper clearfix">
                <div class="widget-list">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <h3 class="box-title">Hasil Seleksi PPDB</h3>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="table-secondary">
                                                    <th class="text-center">No</th>
                                                    <th>Siswa</th>
                                                    <th class="text-center">Semester</th>
                                                    <th class="text-center">Agama</th>
                                                    <th class="text-center">Bahasa Indonesia</th>
                                                    <th class="text-center">Bahasa Inggris</th>
                                                    <th class="text-center">IPA</th>
                                                    <th class="text-center">IPS</th>
                                                    <th class="text-center">Matematika</th>
                                                    <th class="text-center">Jumlah Per Semester</th>
                                                    <th class="text-center">Total Akhir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td rowspan="4" class="align-middle text-center">
                                                        1
                                                    </td>
                                                    <td rowspan="4" class="align-middle">
                                                        Uriah Duran</td>

                                                    <td class="text-center">1</td>
                                                    <td>20</td>
                                                    <td>50</td>
                                                    <td>50</td>
                                                    <td>66</td>
                                                    <td>60</td>
                                                    <td>50</td>
                                                    <td class="text-center">100</td>
                                                    <td rowspan="4" class="align-middle text-center">
                                                        350
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="4" class="align-middle text-center">
                                                        2
                                                    </td>
                                                    <td rowspan="4" class="align-middle">
                                                        Uriah Duran</td>

                                                    <td class="text-center">2</td>
                                                    <td>30</td>
                                                    <td>65</td>
                                                    <td>30</td>
                                                    <td>90</td>
                                                    <td>32</td>
                                                    <td>50</td>
                                                    <td class="text-center">100</td>
                                                    <td rowspan="4" class="align-middle text-center">
                                                        350
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="4" class="align-middle text-center">
                                                        3
                                                    </td>
                                                    <td rowspan="4" class="align-middle">
                                                        Uriah Duran</td>

                                                    <td class="text-center">3</td>
                                                    <td>44</td>
                                                    <td>43</td>
                                                    <td>50</td>
                                                    <td>48</td>
                                                    <td>50</td>
                                                    <td>60</td>
                                                    <td class="text-center">100</td>
                                                    <td rowspan="4" class="align-middle text-center">
                                                        350
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="4" class="align-middle text-center">
                                                        4
                                                    </td>
                                                    <td rowspan="4" class="align-middle">
                                                        Uriah Duran</td>

                                                    <td class="text-center">5</td>
                                                    <td>50</td>
                                                    <td>50</td>
                                                    <td>60</td>
                                                    <td>89</td>
                                                    <td>60</td>
                                                    <td>70</td>
                                                    <td class="text-center">100</td>
                                                    <td rowspan="4" class="align-middle text-center">
                                                        350
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td class="text-center">1</td>
                                                    <td>40</td>
                                                    <td>60</td>
                                                    <td>70</td>
                                                    <td>80</td>
                                                    <td>30</td>
                                                    <td>60</td>
                                                    <td class="text-center">100</td>
                                                </tr>
                                                <tr>

                                                    <td class="text-center">2</td>
                                                    <td>50</td>
                                                    <td>60</td>
                                                    <td>50</td>
                                                    <td>90</td>
                                                    <td>40</td>
                                                    <td>70</td>
                                                    <td class="text-center">100</td>
                                                </tr>
                                                <tr>

                                                    <td class="text-center">3</td>
                                                    <td>40</td>
                                                    <td>30</td>
                                                    <td>50</td>
                                                    <td>20</td>
                                                    <td>50</td>
                                                    <td>80</td>
                                                    <td class="text-center">100</td>
                                                </tr>
                                                <tr>

                                                    <td class="text-center">5</td>
                                                    <td>60</td>
                                                    <td>53</td>
                                                    <td>20</td>
                                                    <td>50</td>
                                                    <td>70</td>
                                                    <td>10</td>
                                                    <td class="text-center">100</td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <footer class="footer text-center clearfix">2017 © Oscar Admin brought to you by UnifatoThemess</footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js"></script>
    <script src="http://localhost:8000/asset/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.3/mediaelementplayer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js">
    </script>
    <script src="http://localhost:8000/asset/js/theme.js"></script>
    <script src="http://localhost:8000/asset/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>

    <script type="text/javascript">
        var phpdebugbar = new PhpDebugBar.DebugBar();
        phpdebugbar.addIndicator("php_version", new PhpDebugBar.DebugBar.Indicator({
            "icon": "code",
            "tooltip": "PHP Version"
        }), "right");
        phpdebugbar.addTab("messages", new PhpDebugBar.DebugBar.Tab({
            "icon": "list-alt",
            "title": "Messages",
            "widget": new PhpDebugBar.Widgets.MessagesWidget()
        }));
        phpdebugbar.addIndicator("time", new PhpDebugBar.DebugBar.Indicator({
            "icon": "clock-o",
            "tooltip": "Request Duration"
        }), "right");
        phpdebugbar.addTab("timeline", new PhpDebugBar.DebugBar.Tab({
            "icon": "tasks",
            "title": "Timeline",
            "widget": new PhpDebugBar.Widgets.TimelineWidget()
        }));
        phpdebugbar.addIndicator("memory", new PhpDebugBar.DebugBar.Indicator({
            "icon": "cogs",
            "tooltip": "Memory Usage"
        }), "right");
        phpdebugbar.addTab("exceptions", new PhpDebugBar.DebugBar.Tab({
            "icon": "bug",
            "title": "Exceptions",
            "widget": new PhpDebugBar.Widgets.ExceptionsWidget()
        }));
        phpdebugbar.addTab("views", new PhpDebugBar.DebugBar.Tab({
            "icon": "leaf",
            "title": "Views",
            "widget": new PhpDebugBar.Widgets.LaravelViewTemplatesWidget()
        }));
        phpdebugbar.addTab("route", new PhpDebugBar.DebugBar.Tab({
            "icon": "share",
            "title": "Route",
            "widget": new PhpDebugBar.Widgets.HtmlVariableListWidget()
        }));
        phpdebugbar.addIndicator("currentroute", new PhpDebugBar.DebugBar.Indicator({
            "icon": "share",
            "tooltip": "Route"
        }), "right");
        phpdebugbar.addTab("queries", new PhpDebugBar.DebugBar.Tab({
            "icon": "database",
            "title": "Queries",
            "widget": new PhpDebugBar.Widgets.LaravelSQLQueriesWidget()
        }));
        phpdebugbar.addTab("models", new PhpDebugBar.DebugBar.Tab({
            "icon": "cubes",
            "title": "Models",
            "widget": new PhpDebugBar.Widgets.HtmlVariableListWidget()
        }));
        phpdebugbar.addTab("gate", new PhpDebugBar.DebugBar.Tab({
            "icon": "list-alt",
            "title": "Gate",
            "widget": new PhpDebugBar.Widgets.MessagesWidget()
        }));
        phpdebugbar.addTab("session", new PhpDebugBar.DebugBar.Tab({
            "icon": "archive",
            "title": "Session",
            "widget": new PhpDebugBar.Widgets.VariableListWidget()
        }));
        phpdebugbar.addTab("request", new PhpDebugBar.DebugBar.Tab({
            "icon": "tags",
            "title": "Request",
            "widget": new PhpDebugBar.Widgets.HtmlVariableListWidget()
        }));
        phpdebugbar.setDataMap({
            "php_version": ["php.version", ],
            "messages": ["messages.messages", []],
            "messages:badge": ["messages.count", null],
            "time": ["time.duration_str", '0ms'],
            "timeline": ["time", {}],
            "memory": ["memory.peak_usage_str", '0B'],
            "exceptions": ["exceptions.exceptions", []],
            "exceptions:badge": ["exceptions.count", null],
            "views": ["views", []],
            "views:badge": ["views.nb_templates", 0],
            "route": ["route", {}],
            "currentroute": ["route.uri", ],
            "queries": ["queries", []],
            "queries:badge": ["queries.nb_statements", 0],
            "models": ["models.data", {}],
            "models:badge": ["models.count", 0],
            "gate": ["gate.messages", []],
            "gate:badge": ["gate.count", null],
            "session": ["session", {}],
            "request": ["request", {}]
        });
        phpdebugbar.restoreState();
        phpdebugbar.ajaxHandler = new PhpDebugBar.AjaxHandler(phpdebugbar, undefined, true);
        phpdebugbar.ajaxHandler.bindToFetch();
        phpdebugbar.ajaxHandler.bindToXHR();
        phpdebugbar.setOpenHandler(new PhpDebugBar.OpenHandler({
            "url": "http:\/\/localhost:8000\/_debugbar\/open"
        }));
        phpdebugbar.addDataSet({
            "__meta": {
                "id": "X8bbc99899a1df14ff45a5a6a97950a1a",
                "datetime": "2023-03-10 11:32:18",
                "utime": 1678422738.541329,
                "method": "GET",
                "uri": "\/score",
                "ip": "127.0.0.1"
            },
            "php": {
                "version": "8.1.12",
                "interface": "cli-server"
            },
            "messages": {
                "count": 0,
                "messages": []
            },
            "time": {
                "start": 1678422737.689849,
                "end": 1678422738.541362,
                "duration": 0.851513147354126,
                "duration_str": "852ms",
                "measures": [{
                    "label": "Booting",
                    "start": 1678422737.689849,
                    "relative_start": 0,
                    "end": 1678422738.062409,
                    "relative_end": 1678422738.062409,
                    "duration": 0.3725600242614746,
                    "duration_str": "373ms",
                    "params": [],
                    "collector": null
                }, {
                    "label": "Application",
                    "start": 1678422738.063535,
                    "relative_start": 0.3736860752105713,
                    "end": 1678422738.541366,
                    "relative_end": 4.0531158447265625e-6,
                    "duration": 0.4778311252593994,
                    "duration_str": "478ms",
                    "params": [],
                    "collector": null
                }]
            },
            "memory": {
                "peak_usage": 43830464,
                "peak_usage_str": "42MB"
            },
            "exceptions": {
                "count": 0,
                "exceptions": []
            },
            "views": {
                "nb_templates": 6,
                "templates": [{
                    "name": "content.public.v_score (\\resources\\views\\content\\public\\v_score.blade.php)",
                    "param_count": 4,
                    "params": ["registration", "amount_semester", "semester", "course"],
                    "type": "blade",
                    "editorLink": "phpstorm:\/\/open?file=C:\\Users\\UMAM\\Documents\\safii\\project\\ppdb-bogor\\resources\\views\/content\/public\/v_score.blade.php&line=0"
                }, {
                    "name": "plugins.component.banner (\\resources\\views\\plugins\\component\\banner.blade.php)",
                    "param_count": 8,
                    "params": ["__env", "app", "errors", "registration", "amount_semester", "semester",
                        "course", "banner"
                    ],
                    "type": "blade",
                    "editorLink": "phpstorm:\/\/open?file=C:\\Users\\UMAM\\Documents\\safii\\project\\ppdb-bogor\\resources\\views\/plugins\/component\/banner.blade.php&line=0"
                }, {
                    "name": "layout.public.main (\\resources\\views\\layout\\public\\main.blade.php)",
                    "param_count": 13,
                    "params": ["__env", "app", "errors", "registration", "amount_semester", "semester",
                        "course", "__currentLoopData", "cs", "loop", "reg", "key", "score"
                    ],
                    "type": "blade",
                    "editorLink": "phpstorm:\/\/open?file=C:\\Users\\UMAM\\Documents\\safii\\project\\ppdb-bogor\\resources\\views\/layout\/public\/main.blade.php&line=0"
                }, {
                    "name": "layout.includes.head (\\resources\\views\\layout\\includes\\head.blade.php)",
                    "param_count": 13,
                    "params": ["__env", "app", "errors", "registration", "amount_semester", "semester",
                        "course", "__currentLoopData", "cs", "loop", "reg", "key", "score"
                    ],
                    "type": "blade",
                    "editorLink": "phpstorm:\/\/open?file=C:\\Users\\UMAM\\Documents\\safii\\project\\ppdb-bogor\\resources\\views\/layout\/includes\/head.blade.php&line=0"
                }, {
                    "name": "layout.public.nav_menu (\\resources\\views\\layout\\public\\nav_menu.blade.php)",
                    "param_count": 13,
                    "params": ["__env", "app", "errors", "registration", "amount_semester", "semester",
                        "course", "__currentLoopData", "cs", "loop", "reg", "key", "score"
                    ],
                    "type": "blade",
                    "editorLink": "phpstorm:\/\/open?file=C:\\Users\\UMAM\\Documents\\safii\\project\\ppdb-bogor\\resources\\views\/layout\/public\/nav_menu.blade.php&line=0"
                }, {
                    "name": "layout.includes.foot (\\resources\\views\\layout\\includes\\foot.blade.php)",
                    "param_count": 13,
                    "params": ["__env", "app", "errors", "registration", "amount_semester", "semester",
                        "course", "__currentLoopData", "cs", "loop", "reg", "key", "score"
                    ],
                    "type": "blade",
                    "editorLink": "phpstorm:\/\/open?file=C:\\Users\\UMAM\\Documents\\safii\\project\\ppdb-bogor\\resources\\views\/layout\/includes\/foot.blade.php&line=0"
                }]
            },
            "route": {
                "uri": "GET score",
                "middleware": "web",
                "controller": "App\\Http\\Controllers\\AnnouncementController@score",
                "namespace": null,
                "prefix": "",
                "where": [],
                "as": "public_score",
                "file": "<a href=\"phpstorm:\/\/open?file=C:\\Users\\UMAM\\Documents\\safii\\project\\ppdb-bogor\\app\\Http\\Controllers\\AnnouncementController.php&line=28\">\\app\\Http\\Controllers\\AnnouncementController.php:28-103<\/a>"
            },
            "queries": {
                "nb_statements": 13,
                "nb_failed_statements": 0,
                "accumulated_duration": 0.020190000000000003,
                "accumulated_duration_str": "20.19ms",
                "statements": [{
                    "sql": "select * from `settings` limit 1",
                    "type": "query",
                    "params": [],
                    "bindings": [],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 18,
                        "namespace": null,
                        "name": "\\app\\Http\\Controllers\\AnnouncementController.php",
                        "line": 30
                    }, {
                        "index": 19,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php",
                        "line": 54
                    }, {
                        "index": 20,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php",
                        "line": 43
                    }, {
                        "index": 21,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 260
                    }, {
                        "index": 22,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 205
                    }],
                    "duration": 0.00455,
                    "duration_str": "4.55ms",
                    "stmt_id": "\\app\\Http\\Controllers\\AnnouncementController.php:30",
                    "connection": "db_ppdb",
                    "start_percent": 0,
                    "width_percent": 22.536
                }, {
                    "sql": "select `sf`.`initial` as `initial`, `sf`.`name` as `course` from `registrations` inner join `setting_forms` as `sf` on `sf`.`id` = `registrations`.`id_form` inner join `setting_type_forms` as `stf` on `stf`.`id` = `sf`.`id_type` where `stf`.`initial` = 'nilai_mapel_raport' and (`sf`.`initial` like '%semester_1%' or `sf`.`initial` like '%semester_2%' or `sf`.`initial` like '%semester_3%' or `sf`.`initial` like '%semester_5%') group by `initial`, `course`",
                    "type": "query",
                    "params": [],
                    "bindings": ["nilai_mapel_raport", "%semester_1%", "%semester_2%", "%semester_3%",
                        "%semester_5%"
                    ],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 14,
                        "namespace": null,
                        "name": "\\app\\Http\\Controllers\\AnnouncementController.php",
                        "line": 45
                    }, {
                        "index": 15,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php",
                        "line": 54
                    }, {
                        "index": 16,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php",
                        "line": 43
                    }, {
                        "index": 17,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 260
                    }, {
                        "index": 18,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 205
                    }],
                    "duration": 0.0015400000000000001,
                    "duration_str": "1.54ms",
                    "stmt_id": "\\app\\Http\\Controllers\\AnnouncementController.php:45",
                    "connection": "db_ppdb",
                    "start_percent": 22.536,
                    "width_percent": 7.628
                }, {
                    "sql": "select `pr`.`id` as `id_participant`, `pr`.`name` as `participant` from `registrations` inner join `participants` as `pr` on `pr`.`id` = `registrations`.`id_participant` group by `pr`.`id`, `pr`.`name`",
                    "type": "query",
                    "params": [],
                    "bindings": [],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 14,
                        "namespace": null,
                        "name": "\\app\\Http\\Controllers\\AnnouncementController.php",
                        "line": 64
                    }, {
                        "index": 15,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php",
                        "line": 54
                    }, {
                        "index": 16,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php",
                        "line": 43
                    }, {
                        "index": 17,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 260
                    }, {
                        "index": 18,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 205
                    }],
                    "duration": 0.00103,
                    "duration_str": "1.03ms",
                    "stmt_id": "\\app\\Http\\Controllers\\AnnouncementController.php:64",
                    "connection": "db_ppdb",
                    "start_percent": 30.163,
                    "width_percent": 5.102
                }, {
                    "sql": "select `registrations`.`value` as `score`, `pr`.`name` as `participant`, `sf`.`name` as `course` from `registrations` inner join `setting_forms` as `sf` on `sf`.`id` = `registrations`.`id_form` inner join `setting_type_forms` as `stf` on `stf`.`id` = `sf`.`id_type` inner join `participants` as `pr` on `pr`.`id` = `registrations`.`id_participant` where `stf`.`initial` = 'nilai_mapel_raport' and `pr`.`id` = 1 and (`sf`.`initial` like '%semester_1')",
                    "type": "query",
                    "params": [],
                    "bindings": ["nilai_mapel_raport", "1", "%semester_1"],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 14,
                        "namespace": null,
                        "name": "\\app\\Http\\Controllers\\AnnouncementController.php",
                        "line": 79
                    }, {
                        "index": 15,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php",
                        "line": 54
                    }, {
                        "index": 16,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php",
                        "line": 43
                    }, {
                        "index": 17,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 260
                    }, {
                        "index": 18,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 205
                    }],
                    "duration": 0.00152,
                    "duration_str": "1.52ms",
                    "stmt_id": "\\app\\Http\\Controllers\\AnnouncementController.php:79",
                    "connection": "db_ppdb",
                    "start_percent": 35.265,
                    "width_percent": 7.528
                }, {
                    "sql": "select `registrations`.`value` as `score`, `pr`.`name` as `participant`, `sf`.`name` as `course` from `registrations` inner join `setting_forms` as `sf` on `sf`.`id` = `registrations`.`id_form` inner join `setting_type_forms` as `stf` on `stf`.`id` = `sf`.`id_type` inner join `participants` as `pr` on `pr`.`id` = `registrations`.`id_participant` where `stf`.`initial` = 'nilai_mapel_raport' and `pr`.`id` = 1 and (`sf`.`initial` like '%semester_2')",
                    "type": "query",
                    "params": [],
                    "bindings": ["nilai_mapel_raport", "1", "%semester_2"],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 14,
                        "namespace": null,
                        "name": "\\app\\Http\\Controllers\\AnnouncementController.php",
                        "line": 79
                    }, {
                        "index": 15,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php",
                        "line": 54
                    }, {
                        "index": 16,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php",
                        "line": 43
                    }, {
                        "index": 17,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 260
                    }, {
                        "index": 18,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 205
                    }],
                    "duration": 0.0015,
                    "duration_str": "1.5ms",
                    "stmt_id": "\\app\\Http\\Controllers\\AnnouncementController.php:79",
                    "connection": "db_ppdb",
                    "start_percent": 42.793,
                    "width_percent": 7.429
                }, {
                    "sql": "select `registrations`.`value` as `score`, `pr`.`name` as `participant`, `sf`.`name` as `course` from `registrations` inner join `setting_forms` as `sf` on `sf`.`id` = `registrations`.`id_form` inner join `setting_type_forms` as `stf` on `stf`.`id` = `sf`.`id_type` inner join `participants` as `pr` on `pr`.`id` = `registrations`.`id_participant` where `stf`.`initial` = 'nilai_mapel_raport' and `pr`.`id` = 1 and (`sf`.`initial` like '%semester_3')",
                    "type": "query",
                    "params": [],
                    "bindings": ["nilai_mapel_raport", "1", "%semester_3"],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 14,
                        "namespace": null,
                        "name": "\\app\\Http\\Controllers\\AnnouncementController.php",
                        "line": 79
                    }, {
                        "index": 15,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php",
                        "line": 54
                    }, {
                        "index": 16,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php",
                        "line": 43
                    }, {
                        "index": 17,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 260
                    }, {
                        "index": 18,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 205
                    }],
                    "duration": 0.0014399999999999999,
                    "duration_str": "1.44ms",
                    "stmt_id": "\\app\\Http\\Controllers\\AnnouncementController.php:79",
                    "connection": "db_ppdb",
                    "start_percent": 50.223,
                    "width_percent": 7.132
                }, {
                    "sql": "select `registrations`.`value` as `score`, `pr`.`name` as `participant`, `sf`.`name` as `course` from `registrations` inner join `setting_forms` as `sf` on `sf`.`id` = `registrations`.`id_form` inner join `setting_type_forms` as `stf` on `stf`.`id` = `sf`.`id_type` inner join `participants` as `pr` on `pr`.`id` = `registrations`.`id_participant` where `stf`.`initial` = 'nilai_mapel_raport' and `pr`.`id` = 1 and (`sf`.`initial` like '%semester_5')",
                    "type": "query",
                    "params": [],
                    "bindings": ["nilai_mapel_raport", "1", "%semester_5"],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 14,
                        "namespace": null,
                        "name": "\\app\\Http\\Controllers\\AnnouncementController.php",
                        "line": 79
                    }, {
                        "index": 15,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php",
                        "line": 54
                    }, {
                        "index": 16,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php",
                        "line": 43
                    }, {
                        "index": 17,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 260
                    }, {
                        "index": 18,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 205
                    }],
                    "duration": 0.00136,
                    "duration_str": "1.36ms",
                    "stmt_id": "\\app\\Http\\Controllers\\AnnouncementController.php:79",
                    "connection": "db_ppdb",
                    "start_percent": 57.355,
                    "width_percent": 6.736
                }, {
                    "sql": "select `registrations`.`value` as `score`, `pr`.`name` as `participant`, `sf`.`name` as `course` from `registrations` inner join `setting_forms` as `sf` on `sf`.`id` = `registrations`.`id_form` inner join `setting_type_forms` as `stf` on `stf`.`id` = `sf`.`id_type` inner join `participants` as `pr` on `pr`.`id` = `registrations`.`id_participant` where `stf`.`initial` = 'nilai_mapel_raport' and `pr`.`id` = 2 and (`sf`.`initial` like '%semester_1')",
                    "type": "query",
                    "params": [],
                    "bindings": ["nilai_mapel_raport", "2", "%semester_1"],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 14,
                        "namespace": null,
                        "name": "\\app\\Http\\Controllers\\AnnouncementController.php",
                        "line": 79
                    }, {
                        "index": 15,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php",
                        "line": 54
                    }, {
                        "index": 16,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php",
                        "line": 43
                    }, {
                        "index": 17,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 260
                    }, {
                        "index": 18,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 205
                    }],
                    "duration": 0.00173,
                    "duration_str": "1.73ms",
                    "stmt_id": "\\app\\Http\\Controllers\\AnnouncementController.php:79",
                    "connection": "db_ppdb",
                    "start_percent": 64.091,
                    "width_percent": 8.569
                }, {
                    "sql": "select `registrations`.`value` as `score`, `pr`.`name` as `participant`, `sf`.`name` as `course` from `registrations` inner join `setting_forms` as `sf` on `sf`.`id` = `registrations`.`id_form` inner join `setting_type_forms` as `stf` on `stf`.`id` = `sf`.`id_type` inner join `participants` as `pr` on `pr`.`id` = `registrations`.`id_participant` where `stf`.`initial` = 'nilai_mapel_raport' and `pr`.`id` = 2 and (`sf`.`initial` like '%semester_2')",
                    "type": "query",
                    "params": [],
                    "bindings": ["nilai_mapel_raport", "2", "%semester_2"],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 14,
                        "namespace": null,
                        "name": "\\app\\Http\\Controllers\\AnnouncementController.php",
                        "line": 79
                    }, {
                        "index": 15,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php",
                        "line": 54
                    }, {
                        "index": 16,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php",
                        "line": 43
                    }, {
                        "index": 17,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 260
                    }, {
                        "index": 18,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 205
                    }],
                    "duration": 0.00152,
                    "duration_str": "1.52ms",
                    "stmt_id": "\\app\\Http\\Controllers\\AnnouncementController.php:79",
                    "connection": "db_ppdb",
                    "start_percent": 72.66,
                    "width_percent": 7.528
                }, {
                    "sql": "select `registrations`.`value` as `score`, `pr`.`name` as `participant`, `sf`.`name` as `course` from `registrations` inner join `setting_forms` as `sf` on `sf`.`id` = `registrations`.`id_form` inner join `setting_type_forms` as `stf` on `stf`.`id` = `sf`.`id_type` inner join `participants` as `pr` on `pr`.`id` = `registrations`.`id_participant` where `stf`.`initial` = 'nilai_mapel_raport' and `pr`.`id` = 2 and (`sf`.`initial` like '%semester_3')",
                    "type": "query",
                    "params": [],
                    "bindings": ["nilai_mapel_raport", "2", "%semester_3"],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 14,
                        "namespace": null,
                        "name": "\\app\\Http\\Controllers\\AnnouncementController.php",
                        "line": 79
                    }, {
                        "index": 15,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php",
                        "line": 54
                    }, {
                        "index": 16,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php",
                        "line": 43
                    }, {
                        "index": 17,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 260
                    }, {
                        "index": 18,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 205
                    }],
                    "duration": 0.00108,
                    "duration_str": "1.08ms",
                    "stmt_id": "\\app\\Http\\Controllers\\AnnouncementController.php:79",
                    "connection": "db_ppdb",
                    "start_percent": 80.188,
                    "width_percent": 5.349
                }, {
                    "sql": "select `registrations`.`value` as `score`, `pr`.`name` as `participant`, `sf`.`name` as `course` from `registrations` inner join `setting_forms` as `sf` on `sf`.`id` = `registrations`.`id_form` inner join `setting_type_forms` as `stf` on `stf`.`id` = `sf`.`id_type` inner join `participants` as `pr` on `pr`.`id` = `registrations`.`id_participant` where `stf`.`initial` = 'nilai_mapel_raport' and `pr`.`id` = 2 and (`sf`.`initial` like '%semester_5')",
                    "type": "query",
                    "params": [],
                    "bindings": ["nilai_mapel_raport", "2", "%semester_5"],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 14,
                        "namespace": null,
                        "name": "\\app\\Http\\Controllers\\AnnouncementController.php",
                        "line": 79
                    }, {
                        "index": 15,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php",
                        "line": 54
                    }, {
                        "index": 16,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php",
                        "line": 43
                    }, {
                        "index": 17,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 260
                    }, {
                        "index": 18,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
                        "line": 205
                    }],
                    "duration": 0.00111,
                    "duration_str": "1.11ms",
                    "stmt_id": "\\app\\Http\\Controllers\\AnnouncementController.php:79",
                    "connection": "db_ppdb",
                    "start_percent": 85.537,
                    "width_percent": 5.498
                }, {
                    "sql": "select * from `banners` limit 1",
                    "type": "query",
                    "params": [],
                    "bindings": [],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 18,
                        "namespace": null,
                        "name": "\\app\\Providers\\AppServiceProvider.php",
                        "line": 45
                    }, {
                        "index": 21,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Concerns\\ManagesEvents.php",
                        "line": 177
                    }, {
                        "index": 22,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php",
                        "line": 176
                    }, {
                        "index": 23,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php",
                        "line": 147
                    }, {
                        "index": 24,
                        "namespace": "view",
                        "name": "11b345f89797a9b486e1f8cb8136a1c7a220ef2c",
                        "line": 14
                    }],
                    "duration": 0.00082,
                    "duration_str": "820\u03bcs",
                    "stmt_id": "\\app\\Providers\\AppServiceProvider.php:45",
                    "connection": "db_ppdb",
                    "start_percent": 91.035,
                    "width_percent": 4.061
                }, {
                    "sql": "select * from `settings` limit 1",
                    "type": "query",
                    "params": [],
                    "bindings": [],
                    "hints": null,
                    "show_copy": false,
                    "backtrace": [{
                        "index": 18,
                        "namespace": null,
                        "name": "\\app\\Providers\\AppServiceProvider.php",
                        "line": 36
                    }, {
                        "index": 19,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Cache\\Repository.php",
                        "line": 397
                    }, {
                        "index": 20,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\Cache\\CacheManager.php",
                        "line": 419
                    }, {
                        "index": 22,
                        "namespace": null,
                        "name": "\\app\\Providers\\AppServiceProvider.php",
                        "line": 41
                    }, {
                        "index": 25,
                        "namespace": null,
                        "name": "\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Concerns\\ManagesEvents.php",
                        "line": 177
                    }],
                    "duration": 0.00099,
                    "duration_str": "990\u03bcs",
                    "stmt_id": "\\app\\Providers\\AppServiceProvider.php:36",
                    "connection": "db_ppdb",
                    "start_percent": 95.097,
                    "width_percent": 4.903
                }]
            },
            "models": {
                "data": {
                    "App\\Models\\Banner": 1,
                    "App\\Models\\Registration": 86,
                    "App\\Models\\Setting": 2
                },
                "count": 89
            },
            "gate": {
                "count": 0,
                "messages": []
            },
            "session": {
                "_token": "kmzDmNKUO3LXOymKiuqIAzFc1D3fUjcQvYvpVf8K",
                "_flash": "array:2 [\n  \"old\" => []\n  \"new\" => []\n]",
                "school_year": "1978",
                "name_program": "Teagan Hall",
                "name_school": "Justina Melendez",
                "logo_school": "logo\/2023030811453052152.png",
                "_previous": "array:1 [\n  \"url\" => \"http:\/\/localhost:8000\/score\"\n]",
                "title": "Pengumuman",
                "PHPDEBUGBAR_STACK_DATA": "[]"
            },
            "request": {
                "path_info": "\/score",
                "status_code": "<pre class=sf-dump id=sf-dump-896665519 data-indent-pad=\"  \"><span class=sf-dump-num>200<\/span>\n<\/pre><script>Sfdump(\"sf-dump-896665519\", {\"maxDepth\":0})<\/script>\n",
                "status_text": "OK",
                "format": "html",
                "content_type": "text\/html; charset=UTF-8",
                "request_query": "<pre class=sf-dump id=sf-dump-135794630 data-indent-pad=\"  \">[]\n<\/pre><script>Sfdump(\"sf-dump-135794630\", {\"maxDepth\":0})<\/script>\n",
                "request_request": "<pre class=sf-dump id=sf-dump-357007780 data-indent-pad=\"  \">[]\n<\/pre><script>Sfdump(\"sf-dump-357007780\", {\"maxDepth\":0})<\/script>\n",
                "request_headers": "<pre class=sf-dump id=sf-dump-14994751 data-indent-pad=\"  \"><span class=sf-dump-note>array:14<\/span> [<samp data-depth=1 class=sf-dump-expanded>\n  \"<span class=sf-dump-key>host<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"14 characters\">localhost:8000<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>connection<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"10 characters\">keep-alive<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>cache-control<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"9 characters\">max-age=0<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>upgrade-insecure-requests<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str>1<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>user-agent<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"111 characters\">Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/110.0.0.0 Safari\/537.36<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>accept<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"96 characters\">text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/avif,image\/webp,image\/apng,*\/*;q=0.8<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-gpc<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str>1<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>accept-language<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"8 characters\">en-US,en<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-fetch-site<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"4 characters\">none<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-fetch-mode<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"8 characters\">navigate<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-fetch-user<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"2 characters\">?1<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-fetch-dest<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"8 characters\">document<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>accept-encoding<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"17 characters\">gzip, deflate, br<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>cookie<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"818 characters\">ckCsrfToken=zyerL3SeiRH8Q1bhNgpP4BTX3pFCyFMqpg53cnUW; sidebar_toggle_state=off; io=JDK-lv8fi00AbVapAAAE; XSRF-TOKEN=eyJpdiI6IkpLMEVUM3pYamFkN1JCOVl4eWd1aEE9PSIsInZhbHVlIjoiUGZ1em5oZEhMYVdxKzNPQXJ1VG9HeGQvZUl5T3JtQnMrRGtVNEdTOFJEQ2xLcW5lcVVlVmo2VGJPZS9ENEJmSUVwaXFaaXJweDM1Yno1a1RGK3NYVmF1bDRQUnJOSHl3ajEvMXBCdUxWVWVmVDkyNVZkbUE0c0RaWSs0am1RdysiLCJtYWMiOiI3YjM1ZDdiOWFkODYxYWVkMzM2NjliZDQ0NDNiM2NiODA3ODYyMGMwMzgwOTEwOWEwZTE2MTc1NGI0OWZmZTJhIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Imp4QjU4SVV6c1B6R2UrTjhsaUlqcHc9PSIsInZhbHVlIjoiYmFaanhMVmtNWG02ci9UZlJFdFdZb2pBZWwwOEsxTkdxT1VscjVGQ0pQUW5mUFMyYUxlVDFGWTlHQTRTZVhCd1lhekRyeXVTYzNoTEJSbEtDU0hzR1VZejBBSFdIRHpibnNvQzJGTmc0ckNNNHErVXRHaWFPTUZrRDF5NDgzOVQiLCJtYWMiOiJmMjM4OWIxMjMxZGI0YjE2Y2UxYWI1MzI2N2E5MDY2YzQzMmMyNGFmODM0ZjQxNGI5NjM3ZjBlMjVkNGMwNjhjIiwidGFnIjoiIn0%3D<\/span>\"\n  <\/samp>]\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-14994751\", {\"maxDepth\":0})<\/script>\n",
                "request_server": "<pre class=sf-dump id=sf-dump-355763651 data-indent-pad=\"  \"><span class=sf-dump-note>array:29<\/span> [<samp data-depth=1 class=sf-dump-expanded>\n  \"<span class=sf-dump-key>DOCUMENT_ROOT<\/span>\" => \"<span class=sf-dump-str title=\"55 characters\">C:\\Users\\UMAM\\Documents\\safii\\project\\ppdb-bogor\\public<\/span>\"\n  \"<span class=sf-dump-key>REMOTE_ADDR<\/span>\" => \"<span class=sf-dump-str title=\"9 characters\">127.0.0.1<\/span>\"\n  \"<span class=sf-dump-key>REMOTE_PORT<\/span>\" => \"<span class=sf-dump-str title=\"5 characters\">55355<\/span>\"\n  \"<span class=sf-dump-key>SERVER_SOFTWARE<\/span>\" => \"<span class=sf-dump-str title=\"29 characters\">PHP 8.1.12 Development Server<\/span>\"\n  \"<span class=sf-dump-key>SERVER_PROTOCOL<\/span>\" => \"<span class=sf-dump-str title=\"8 characters\">HTTP\/1.1<\/span>\"\n  \"<span class=sf-dump-key>SERVER_NAME<\/span>\" => \"<span class=sf-dump-str title=\"9 characters\">127.0.0.1<\/span>\"\n  \"<span class=sf-dump-key>SERVER_PORT<\/span>\" => \"<span class=sf-dump-str title=\"4 characters\">8000<\/span>\"\n  \"<span class=sf-dump-key>REQUEST_URI<\/span>\" => \"<span class=sf-dump-str title=\"6 characters\">\/score<\/span>\"\n  \"<span class=sf-dump-key>REQUEST_METHOD<\/span>\" => \"<span class=sf-dump-str title=\"3 characters\">GET<\/span>\"\n  \"<span class=sf-dump-key>SCRIPT_NAME<\/span>\" => \"<span class=sf-dump-str title=\"10 characters\">\/index.php<\/span>\"\n  \"<span class=sf-dump-key>SCRIPT_FILENAME<\/span>\" => \"<span class=sf-dump-str title=\"65 characters\">C:\\Users\\UMAM\\Documents\\safii\\project\\ppdb-bogor\\public\\index.php<\/span>\"\n  \"<span class=sf-dump-key>PATH_INFO<\/span>\" => \"<span class=sf-dump-str title=\"6 characters\">\/score<\/span>\"\n  \"<span class=sf-dump-key>PHP_SELF<\/span>\" => \"<span class=sf-dump-str title=\"16 characters\">\/index.php\/score<\/span>\"\n  \"<span class=sf-dump-key>HTTP_HOST<\/span>\" => \"<span class=sf-dump-str title=\"14 characters\">localhost:8000<\/span>\"\n  \"<span class=sf-dump-key>HTTP_CONNECTION<\/span>\" => \"<span class=sf-dump-str title=\"10 characters\">keep-alive<\/span>\"\n  \"<span class=sf-dump-key>HTTP_CACHE_CONTROL<\/span>\" => \"<span class=sf-dump-str title=\"9 characters\">max-age=0<\/span>\"\n  \"<span class=sf-dump-key>HTTP_UPGRADE_INSECURE_REQUESTS<\/span>\" => \"<span class=sf-dump-str>1<\/span>\"\n  \"<span class=sf-dump-key>HTTP_USER_AGENT<\/span>\" => \"<span class=sf-dump-str title=\"111 characters\">Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/110.0.0.0 Safari\/537.36<\/span>\"\n  \"<span class=sf-dump-key>HTTP_ACCEPT<\/span>\" => \"<span class=sf-dump-str title=\"96 characters\">text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/avif,image\/webp,image\/apng,*\/*;q=0.8<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_GPC<\/span>\" => \"<span class=sf-dump-str>1<\/span>\"\n  \"<span class=sf-dump-key>HTTP_ACCEPT_LANGUAGE<\/span>\" => \"<span class=sf-dump-str title=\"8 characters\">en-US,en<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_FETCH_SITE<\/span>\" => \"<span class=sf-dump-str title=\"4 characters\">none<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_FETCH_MODE<\/span>\" => \"<span class=sf-dump-str title=\"8 characters\">navigate<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_FETCH_USER<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">?1<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_FETCH_DEST<\/span>\" => \"<span class=sf-dump-str title=\"8 characters\">document<\/span>\"\n  \"<span class=sf-dump-key>HTTP_ACCEPT_ENCODING<\/span>\" => \"<span class=sf-dump-str title=\"17 characters\">gzip, deflate, br<\/span>\"\n  \"<span class=sf-dump-key>HTTP_COOKIE<\/span>\" => \"<span class=sf-dump-str title=\"818 characters\">ckCsrfToken=zyerL3SeiRH8Q1bhNgpP4BTX3pFCyFMqpg53cnUW; sidebar_toggle_state=off; io=JDK-lv8fi00AbVapAAAE; XSRF-TOKEN=eyJpdiI6IkpLMEVUM3pYamFkN1JCOVl4eWd1aEE9PSIsInZhbHVlIjoiUGZ1em5oZEhMYVdxKzNPQXJ1VG9HeGQvZUl5T3JtQnMrRGtVNEdTOFJEQ2xLcW5lcVVlVmo2VGJPZS9ENEJmSUVwaXFaaXJweDM1Yno1a1RGK3NYVmF1bDRQUnJOSHl3ajEvMXBCdUxWVWVmVDkyNVZkbUE0c0RaWSs0am1RdysiLCJtYWMiOiI3YjM1ZDdiOWFkODYxYWVkMzM2NjliZDQ0NDNiM2NiODA3ODYyMGMwMzgwOTEwOWEwZTE2MTc1NGI0OWZmZTJhIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Imp4QjU4SVV6c1B6R2UrTjhsaUlqcHc9PSIsInZhbHVlIjoiYmFaanhMVmtNWG02ci9UZlJFdFdZb2pBZWwwOEsxTkdxT1VscjVGQ0pQUW5mUFMyYUxlVDFGWTlHQTRTZVhCd1lhekRyeXVTYzNoTEJSbEtDU0hzR1VZejBBSFdIRHpibnNvQzJGTmc0ckNNNHErVXRHaWFPTUZrRDF5NDgzOVQiLCJtYWMiOiJmMjM4OWIxMjMxZGI0YjE2Y2UxYWI1MzI2N2E5MDY2YzQzMmMyNGFmODM0ZjQxNGI5NjM3ZjBlMjVkNGMwNjhjIiwidGFnIjoiIn0%3D<\/span>\"\n  \"<span class=sf-dump-key>REQUEST_TIME_FLOAT<\/span>\" => <span class=sf-dump-num>1678422737.6898<\/span>\n  \"<span class=sf-dump-key>REQUEST_TIME<\/span>\" => <span class=sf-dump-num>1678422737<\/span>\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-355763651\", {\"maxDepth\":0})<\/script>\n",
                "request_cookies": "<pre class=sf-dump id=sf-dump-1465384184 data-indent-pad=\"  \"><span class=sf-dump-note>array:5<\/span> [<samp data-depth=1 class=sf-dump-expanded>\n  \"<span class=sf-dump-key>ckCsrfToken<\/span>\" => <span class=sf-dump-const>null<\/span>\n  \"<span class=sf-dump-key>sidebar_toggle_state<\/span>\" => <span class=sf-dump-const>null<\/span>\n  \"<span class=sf-dump-key>io<\/span>\" => <span class=sf-dump-const>null<\/span>\n  \"<span class=sf-dump-key>XSRF-TOKEN<\/span>\" => \"<span class=sf-dump-str title=\"40 characters\">kmzDmNKUO3LXOymKiuqIAzFc1D3fUjcQvYvpVf8K<\/span>\"\n  \"<span class=sf-dump-key>laravel_session<\/span>\" => \"<span class=sf-dump-str title=\"40 characters\">0VWwK5ExhL1FnYMfLrdKcOUxCHV5DYFS4ye7o53B<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-1465384184\", {\"maxDepth\":0})<\/script>\n",
                "response_headers": "<pre class=sf-dump id=sf-dump-926335981 data-indent-pad=\"  \"><span class=sf-dump-note>array:5<\/span> [<samp data-depth=1 class=sf-dump-expanded>\n  \"<span class=sf-dump-key>content-type<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"24 characters\">text\/html; charset=UTF-8<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>cache-control<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"17 characters\">no-cache, private<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>date<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"29 characters\">Fri, 10 Mar 2023 04:32:18 GMT<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>set-cookie<\/span>\" => <span class=sf-dump-note>array:2<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"428 characters\">XSRF-TOKEN=eyJpdiI6ImdzNDEzQVpBTTBNL3JtYXg0LzdzSUE9PSIsInZhbHVlIjoidzZJOCtaSWVXOW1wN3J5cmRTWG5hdm9CRWtiSW50cEhwNXl6TThUTnl3bXZrQUFOUXZvSm5ON01pOVF5WjZDUGJnRE5teTU3M2dYazJYRjBKWk9pV1VZaFJOU3JzWDJxYXZJS1FwSkdFL0lMTE9HMkZuRW1LRDJ3Vm5tUEx6amUiLCJtYWMiOiI5YTA2OWVmZTA2NWI5MzI2ZjQzMTQwNTFlYjdlNjMwMDc3YjMzMTI3OGExODYyMDFlN2Y3MGFhODNjMWQ0Mzk2IiwidGFnIjoiIn0%3D; expires=Fri, 10 Mar 2023 06:32:18 GMT; Max-Age=7200; path=\/; samesite=lax<\/span>\"\n    <span class=sf-dump-index>1<\/span> => \"<span class=sf-dump-str title=\"443 characters\">laravel_session=eyJpdiI6IjJGTXVYK3EybWdkV1dNZFpYT0E3bWc9PSIsInZhbHVlIjoiR3Nlcy8zajJ1WjM3NUdGMDVMZ04rZVRhRm1lZnY3Um5Qbm5SZmR6bFg5SXhTSnh1dU1TMWwyU2ZGR2FkSDRXaHMvdXNxcnJhdW1EdFBhL1FlelhDNEtXeWR3U3JHQ1ViVzB6SHhxS2tGcElDRzR5WlVrdEl4Sm42R0JuSHN1MFYiLCJtYWMiOiJiYWRlOWUxODA1YjBkMGM4NmZmMjliNjg0YjA1MzE1M2M4OWYzYzYxZDcwOWE2NzE2MzMyZWVhZWE1NTA4M2U5IiwidGFnIjoiIn0%3D; expires=Fri, 10 Mar 2023 06:32:18 GMT; Max-Age=7200; path=\/; httponly; samesite=lax<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>Set-Cookie<\/span>\" => <span class=sf-dump-note>array:2<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"400 characters\">XSRF-TOKEN=eyJpdiI6ImdzNDEzQVpBTTBNL3JtYXg0LzdzSUE9PSIsInZhbHVlIjoidzZJOCtaSWVXOW1wN3J5cmRTWG5hdm9CRWtiSW50cEhwNXl6TThUTnl3bXZrQUFOUXZvSm5ON01pOVF5WjZDUGJnRE5teTU3M2dYazJYRjBKWk9pV1VZaFJOU3JzWDJxYXZJS1FwSkdFL0lMTE9HMkZuRW1LRDJ3Vm5tUEx6amUiLCJtYWMiOiI5YTA2OWVmZTA2NWI5MzI2ZjQzMTQwNTFlYjdlNjMwMDc3YjMzMTI3OGExODYyMDFlN2Y3MGFhODNjMWQ0Mzk2IiwidGFnIjoiIn0%3D; expires=Fri, 10-Mar-2023 06:32:18 GMT; path=\/<\/span>\"\n    <span class=sf-dump-index>1<\/span> => \"<span class=sf-dump-str title=\"415 characters\">laravel_session=eyJpdiI6IjJGTXVYK3EybWdkV1dNZFpYT0E3bWc9PSIsInZhbHVlIjoiR3Nlcy8zajJ1WjM3NUdGMDVMZ04rZVRhRm1lZnY3Um5Qbm5SZmR6bFg5SXhTSnh1dU1TMWwyU2ZGR2FkSDRXaHMvdXNxcnJhdW1EdFBhL1FlelhDNEtXeWR3U3JHQ1ViVzB6SHhxS2tGcElDRzR5WlVrdEl4Sm42R0JuSHN1MFYiLCJtYWMiOiJiYWRlOWUxODA1YjBkMGM4NmZmMjliNjg0YjA1MzE1M2M4OWYzYzYxZDcwOWE2NzE2MzMyZWVhZWE1NTA4M2U5IiwidGFnIjoiIn0%3D; expires=Fri, 10-Mar-2023 06:32:18 GMT; path=\/; httponly<\/span>\"\n  <\/samp>]\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-926335981\", {\"maxDepth\":0})<\/script>\n",
                "session_attributes": "<pre class=sf-dump id=sf-dump-1176252003 data-indent-pad=\"  \"><span class=sf-dump-note>array:9<\/span> [<samp data-depth=1 class=sf-dump-expanded>\n  \"<span class=sf-dump-key>_token<\/span>\" => \"<span class=sf-dump-str title=\"40 characters\">kmzDmNKUO3LXOymKiuqIAzFc1D3fUjcQvYvpVf8K<\/span>\"\n  \"<span class=sf-dump-key>_flash<\/span>\" => <span class=sf-dump-note>array:2<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    \"<span class=sf-dump-key>old<\/span>\" => []\n    \"<span class=sf-dump-key>new<\/span>\" => []\n  <\/samp>]\n  \"<span class=sf-dump-key>school_year<\/span>\" => \"<span class=sf-dump-str title=\"4 characters\">1978<\/span>\"\n  \"<span class=sf-dump-key>name_program<\/span>\" => \"<span class=sf-dump-str title=\"11 characters\">Teagan Hall<\/span>\"\n  \"<span class=sf-dump-key>name_school<\/span>\" => \"<span class=sf-dump-str title=\"16 characters\">Justina Melendez<\/span>\"\n  \"<span class=sf-dump-key>logo_school<\/span>\" => \"<span class=sf-dump-str title=\"28 characters\">logo\/2023030811453052152.png<\/span>\"\n  \"<span class=sf-dump-key>_previous<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    \"<span class=sf-dump-key>url<\/span>\" => \"<span class=sf-dump-str title=\"27 characters\">http:\/\/localhost:8000\/score<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>title<\/span>\" => \"<span class=sf-dump-str title=\"10 characters\">Pengumuman<\/span>\"\n  \"<span class=sf-dump-key>PHPDEBUGBAR_STACK_DATA<\/span>\" => []\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-1176252003\", {\"maxDepth\":0})<\/script>\n"
            }
        }, "X8bbc99899a1df14ff45a5a6a97950a1a");
    </script>
</body>

</html>
