function linktitles(selector, action) {
    document.querySelectorAll(selector).forEach((elmt) => {
        elmt.querySelectorAll('a:not([href*="//"]):not([title])').forEach((link) => {
            const url = link.getAttribute('href'),
                idx = url.lastIndexOf('/');
            if (idx > -1)   {
                fetch(url.slice(0, idx) + '/' + action + url.slice(idx))
                    .then(resp => resp.json())
                    .then(d => { if (d.title) link.title = d.title; });
            }
        });
    });
}
