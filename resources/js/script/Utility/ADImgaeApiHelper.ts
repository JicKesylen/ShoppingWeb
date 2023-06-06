import { ApiMethods } from "../enum/ApiMethods";
import ApiHelper from "./ApiHelper";

const Api = {
    "GetADImage": "/api/GetADImage",
}

export default class ADImageApiHelper {
    public static GetADImageURL() {
        return ApiHelper.callSelf(ApiMethods.POST, Api.GetADImage);
    }
}