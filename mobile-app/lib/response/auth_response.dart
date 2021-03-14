// To parse this JSON data, do
//
//     final loginResponse = loginResponseFromJson(jsonString);

import 'dart:convert';

class LoginResponse {
  LoginResponse({
    this.id,
    this.name,
    this.email,
    this.phoneNumber,
    this.emailVerifiedAt,
    this.status,
    this.token,
    this.provinceId,
    this.regencyId,
    this.districtId,
    this.villageId,
    this.address,
    this.rt,
    this.rw,
    this.point,
    this.qrcode,
    this.createdAt,
    this.updatedAt,
    this.deletedAt,
    this.createdBy,
    this.updatedBy,
    this.deletedBy,
    this.groups,
  });

  int id;
  String name;
  String email;
  String phoneNumber;
  DateTime emailVerifiedAt;
  int status;
  String token;
  dynamic provinceId;
  dynamic regencyId;
  dynamic districtId;
  dynamic villageId;
  String address;
  dynamic rt;
  dynamic rw;
  String point;
  String qrcode;
  dynamic createdAt;
  DateTime updatedAt;
  dynamic deletedAt;
  dynamic createdBy;
  dynamic updatedBy;
  dynamic deletedBy;
  List<Group> groups;

  factory LoginResponse.fromRawJson(String str) =>
      LoginResponse.fromJson(json.decode(str));

  String toRawJson() => json.encode(toJson());

  factory LoginResponse.fromJson(Map<String, dynamic> json) => LoginResponse(
        id: json["id"] == null ? null : json["id"],
        name: json["name"] == null ? null : json["name"],
        email: json["email"] == null ? null : json["email"],
        phoneNumber: json["phone_number"] == null ? null : json["phone_number"],
        emailVerifiedAt: json["email_verified_at"] == null
            ? null
            : DateTime.parse(json["email_verified_at"]),
        status: json["status"] == null ? null : json["status"],
        token: json["token"] == null ? null : json["token"],
        provinceId: json["province_id"],
        regencyId: json["regency_id"],
        districtId: json["district_id"],
        villageId: json["village_id"],
        address: json["address"] == null ? null : json["address"],
        rt: json["rt"],
        rw: json["rw"],
        point: json["point"] == null ? null : json["point"],
        qrcode: json["qrcode"] == null ? null : json["qrcode"],
        createdAt: json["created_at"],
        updatedAt: json["updated_at"] == null
            ? null
            : DateTime.parse(json["updated_at"]),
        deletedAt: json["deleted_at"],
        createdBy: json["created_by"],
        updatedBy: json["updated_by"],
        deletedBy: json["deleted_by"],
        groups: json["groups"] == null
            ? null
            : List<Group>.from(json["groups"].map((x) => Group.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "id": id == null ? null : id,
        "name": name == null ? null : name,
        "email": email == null ? null : email,
        "phone_number": phoneNumber == null ? null : phoneNumber,
        "email_verified_at":
            emailVerifiedAt == null ? null : emailVerifiedAt.toIso8601String(),
        "status": status == null ? null : status,
        "token": token == null ? null : token,
        "province_id": provinceId,
        "regency_id": regencyId,
        "district_id": districtId,
        "village_id": villageId,
        "address": address == null ? null : address,
        "rt": rt,
        "rw": rw,
        "point": point == null ? null : point,
        "qrcode": qrcode == null ? null : qrcode,
        "created_at": createdAt,
        "updated_at": updatedAt == null ? null : updatedAt.toIso8601String(),
        "deleted_at": deletedAt,
        "created_by": createdBy,
        "updated_by": updatedBy,
        "deleted_by": deletedBy,
        "groups": groups == null
            ? null
            : List<dynamic>.from(groups.map((x) => x.toJson())),
      };
}

class Group {
  Group({
    this.id,
    this.name,
    this.description,
    this.createdAt,
    this.updatedAt,
    this.pivot,
  });

  int id;
  String name;
  String description;
  dynamic createdAt;
  dynamic updatedAt;
  Pivot pivot;

  factory Group.fromRawJson(String str) => Group.fromJson(json.decode(str));

  String toRawJson() => json.encode(toJson());

  factory Group.fromJson(Map<String, dynamic> json) => Group(
        id: json["id"] == null ? null : json["id"],
        name: json["name"] == null ? null : json["name"],
        description: json["description"] == null ? null : json["description"],
        createdAt: json["created_at"],
        updatedAt: json["updated_at"],
        pivot: json["pivot"] == null ? null : Pivot.fromJson(json["pivot"]),
      );

  Map<String, dynamic> toJson() => {
        "id": id == null ? null : id,
        "name": name == null ? null : name,
        "description": description == null ? null : description,
        "created_at": createdAt,
        "updated_at": updatedAt,
        "pivot": pivot == null ? null : pivot.toJson(),
      };
}

class Pivot {
  Pivot({
    this.userId,
    this.groupId,
    this.createdAt,
    this.updatedAt,
  });

  int userId;
  int groupId;
  DateTime createdAt;
  DateTime updatedAt;

  factory Pivot.fromRawJson(String str) => Pivot.fromJson(json.decode(str));

  String toRawJson() => json.encode(toJson());

  factory Pivot.fromJson(Map<String, dynamic> json) => Pivot(
        userId: json["user_id"] == null ? null : json["user_id"],
        groupId: json["group_id"] == null ? null : json["group_id"],
        createdAt: json["created_at"] == null
            ? null
            : DateTime.parse(json["created_at"]),
        updatedAt: json["updated_at"] == null
            ? null
            : DateTime.parse(json["updated_at"]),
      );

  Map<String, dynamic> toJson() => {
        "user_id": userId == null ? null : userId,
        "group_id": groupId == null ? null : groupId,
        "created_at": createdAt == null ? null : createdAt.toIso8601String(),
        "updated_at": updatedAt == null ? null : updatedAt.toIso8601String(),
      };
}

class CheckTokenResponse {
  CheckTokenResponse({
    this.message,
    this.status,
    this.code,
    this.data,
  });

  String message;
  bool status;
  int code;
  dynamic data;

  factory CheckTokenResponse.fromRawJson(String str) =>
      CheckTokenResponse.fromJson(json.decode(str));

  String toRawJson() => json.encode(toJson());

  factory CheckTokenResponse.fromJson(Map<String, dynamic> json) =>
      CheckTokenResponse(
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
