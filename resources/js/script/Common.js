const md5 = require('md5');
const common = {
    log(text) {
        if (process.env.MIX_APP_DEBUG == "true") {
            console.debug(text);
        }
    },
    
    md5(s) {
        return md5(`fore${s}see`);
    },

    setCookie(cname, cvalue) {
        switch (typeof cvalue) {
            case "object":
                cvalue = JSON.stringify(cvalue);
                break;
        }
        var exdays = 1;
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    },

    getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                let target = c.substring(name.length, c.length);
                try {
                    target = JSON.parse(target);
                } catch (error) {
                }
                return target;
            }
        }
        return "";
    },
}
Object.assign(window, common);