import 'dart:convert';

class LoginRequest {
  LoginRequest({
    this.email,
    this.password,
  });

  String email;
  String password;

  factory LoginRequest.fromRawJson(String str) =>
      LoginRequest.fromJson(json.decode(str));

  String toRawJson() => json.encode(toJson());

  factory LoginRequest.fromJson(Map<String, dynamic> json) => LoginRequest(
        email: json["email"] == null ? null : json["email"],
        password: json["password"] == null ? null : json["password"],
      );

  Map<String, dynamic> toJson() => {
        "email": email == null ? null : email,
        "password": password == null ? null : password,
      };
}

class CheckTokenRequest {
  CheckTokenRequest({
    this.token,
  });

  String token;

  factory CheckTokenRequest.fromRawJson(String str) =>
      CheckTokenRequest.fromJson(json.decode(str));

  String toRawJson() => json.encode(toJson());

  factory CheckTokenRequest.fromJson(Map<String, dynamic> json) =>
      CheckTokenRequest(
        token: json["token"] == null ? null : json["token"],
      );

  Map<String, dynamic> toJson() => {
        "token": token == null ? null : token,
      };
}
