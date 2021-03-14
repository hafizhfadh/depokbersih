import 'dart:convert';
import 'dart:developer';

import 'package:dio/dio.dart';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';

class ApiBaseHelper {
  static String rootUrl = "http://192.168.1.4:8000";
  static Dio http = Dio();

  static Future<Map<String, String>> createTokenizedHeader() async {
    final _storage = FlutterSecureStorage();
    return <String, String>{
      'Content-Type': 'application/json; charset=UTF-8',
      'user-token': await _storage.read(key: "TOKEN"),
    };
  }

  static Future<Response> postAsync(
    String url, {
    Map<String, String> headers,
    String body,
  }) async {
    try {
      http.options.headers.addAll(await createTokenizedHeader());
      if (headers != null) {
        http.options.headers.addAll(headers);
      }
      // Execute pre-query protocols.
      Stopwatch _stopwatch = Stopwatch()..start();
      log("Started calling POST $url");

      // Execute main query protocols.
      Response response = await http.post(rootUrl + url, data: body);

      // Execute post-query protocols.
      _stopwatch.stop();

      log("Completed!\n"
          "URL:\n$url\n"
          "Headers:${await createTokenizedHeader()}\n"
          "Request Body:\n$body\n"
          "Response Time:\n${_stopwatch.elapsed.inMilliseconds} ms\n"
          "Status Code:\n${response?.statusCode}\n"
          "Response Body:\n${response?.data}\n"
          "Message:\n${response.statusMessage}");

      // Return the obtained response.
      return response;
    } catch (error) {
      log(error.toString());
      rethrow;
    }
  }

  static ApiException createApiException(Response response) {
    if (response.data == null || response.data == "") {
      return ApiException(
          status: false,
          statusCode: response.statusCode,
          statusDesc: response.statusMessage);
    }

    final failed = FailedResponse.fromRawJson(response.data);
    return ApiException(
        status: failed.status,
        statusCode: failed.code,
        statusDesc: failed.message);
  }
}

class ApiResponse<T> {
  ApiResponse({
    this.message,
    this.status,
    this.code,
    this.data,
  });

  String message;
  bool status;
  int code;
  T data;

  factory ApiResponse.fromRawJson(String str) =>
      ApiResponse.fromJson(json.decode(str));

  factory ApiResponse.fromJson(Map<String, dynamic> json) => ApiResponse(
        message: json["message"] == null ? null : json["message"],
        status: json["status"] == null ? null : json["status"],
        code: json["code"] == null ? null : json["code"],
        data: json["data"] == null ? null : json["data"],
      );
}

class ApiException implements Exception {
  ApiException({
    this.status,
    this.statusCode,
    this.statusDesc,
  });

  bool status;
  int statusCode;
  String statusDesc;

  @override
  String toString() {
    return '$status [${statusCode.toString()}]';
  }

  String toStringDetailed() {
    return '$status [${statusCode.toString()}] $statusDesc';
  }
}

class FailedResponse {
  FailedResponse({
    this.message,
    this.status,
    this.code,
    this.data,
  });

  String message;
  bool status;
  int code;
  dynamic data;

  factory FailedResponse.fromRawJson(String str) =>
      FailedResponse.fromJson(json.decode(str));

  String toRawJson() => json.encode(toJson());

  factory FailedResponse.fromJson(Map<String, dynamic> json) => FailedResponse(
        message: json["message"] == null ? null : json["message"],
        status: json["status"] == null ? null : json["status"],
        code: json["code"] == null ? null : json["code"],
        data: json["data"],
      );

  Map<String, dynamic> toJson() => {
        "message": message == null ? null : message,
        "status": status == null ? null : status,
        "code": code == null ? null : code,
        "data": data,
      };
}
