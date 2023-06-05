import { ApiMethods } from "../enum/ApiMethods";
export default class ApiHelper {
    public static getUrl(url: string | string, data: any | null) {
        const getParams = data ?
            (Object.keys(data).filter((key) => data[key]).map((key) => {
                let value = data[key];
                switch (typeof value) {
                    case "object":
                        value = JSON.stringify(value);
                }
                return `${key}=${value}`
            }).join("&")) : "";
        return `${url}?${encodeURI(getParams)}`;
    }

    public static callSelf(method: ApiMethods, path: string , data: any = null): Promise<any> {
        return this.call(method, location.origin + path, data);
    }

    public static call(method: ApiMethods, url: string, data: any = null): Promise<any> {
        let apiFullUrl: string = url;
        const fetchParams: RequestInit = {
            method: method.toString(),
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, same-origin, *omit
            body: null,
            headers: {
                'user-agent': 'Mozilla/4.0 Louyiai',
                'content-type': 'application/json',
            },
            mode: 'cors', // no-cors, cors, *same-origin
            redirect: 'follow', // manual, *follow, error
            referrer: 'no-referrer', // *client, no-referrer
        }
        if (!data) {
            data = {};
        }
        if (method == ApiMethods.GET) {
            apiFullUrl = this.getUrl(url, data);
            log(`${method}: ${apiFullUrl}`);
        } else {
            fetchParams.body = data ? JSON.stringify(data) : ""; // must match 'Content-Type' header
            log(`${method}: ${apiFullUrl}`);
            log(fetchParams.body);
        }

        return fetch(apiFullUrl, fetchParams).then(response => {
            return response.json();
        }).then(json => {
            log(`response from: ${apiFullUrl}`);
            log(json);
            /* if (json.result != 'OK') {
                throw { message: `${json.message ? json.message : '執行失敗'}(${json.errorCode})`, errorCode: json.errorCode };
            } */
            if (!json.success) {
                throw { message: `${json.message ? json.message : '執行失敗'}(${json.errorCode})`, errorCode: json.errorCode };
            }
            else {
                return json;
            }
        }).catch((e) => {
            if (e.name == "SyntaxError") {
                throw new Error('系統出現意外狀況, 請稍後再試');
            } else {
                throw e;
            }
        });
    }
}