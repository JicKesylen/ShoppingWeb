import { ApiMethods } from "../enum/ApiMethods";
import ApiHelper from "./ApiHelper";

const Api = {
    "GetProduct": "/api/GetProduct",
}

export default class ADImageApiHelper {
    public static GetProduct() {
        return ApiHelper.callSelf(ApiMethods.POST, Api.GetProduct);
    }
}