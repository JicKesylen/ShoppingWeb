import { ApiMethods } from "../enum/ApiMethods";
import ApiHelper from "./ApiHelper";

const Api = {
    "Answer": "/api/UserInfo/FaceShapeTest/Answer",
}
export default class UserLineApiHelper {
    
    public static UserAnswer(params: Object){
        return ApiHelper.callSelf(ApiMethods.POST, Api.Answer, params);
    }
}