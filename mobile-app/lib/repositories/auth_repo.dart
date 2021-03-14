import 'package:depokbersih/request/auth_request.dart';
import 'package:depokbersih/response/auth_response.dart';
import 'package:depokbersih/utils/api_service.dart';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';

class AuthRepository {
  static FlutterSecureStorage _storage = FlutterSecureStorage();

  static Future<LoginResponse> loginAsync(LoginRequest request) async {
    final res = await ApiBaseHelper.postAsync(
      "/api/login",
      body: request.toRawJson(),
    );

    if (res.statusCode == 200) {
      ApiResponse result = ApiResponse.fromJson(res.data);
      return LoginResponse.fromJson(result.data);
    }

    throw ApiBaseHelper.createApiException(res);
  }

  static Future<CheckTokenResponse> checkRegisterTokenAsync(
      CheckTokenRequest request) async {
    final res = await ApiBaseHelper.postAsync(
      "/api/check-token",
      body: request.toRawJson(),
    );

    if (res.statusCode == 200) {
      return CheckTokenResponse.fromJson(res.data);
    }

    throw ApiBaseHelper.createApiException(res);
  }

  static Future<LoginResponse> logOutAsync() async {
    final res = await ApiBaseHelper.postAsync(
      "/api/login",
      body: await _storage.read(key: "TOKEN"),
    );

    if (res.statusCode == 200) {
      ApiResponse result = ApiResponse.fromJson(res.data);
      return LoginResponse.fromJson(result.data);
    }

    throw ApiBaseHelper.createApiException(res);
  }
}
