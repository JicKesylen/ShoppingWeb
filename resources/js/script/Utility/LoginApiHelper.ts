import { ApiMethods } from "../enum/ApiMethods";
import ApiHelper from "./ApiHelper";

const Api = {
    "SignUp": "/api/User/SignUp",
}
export default class UserLineApiHelper {
    
    public static SignUp(params: Object){
        return ApiHelper.callSelf(ApiMethods.POST, Api.SignUp, params);
    }
}