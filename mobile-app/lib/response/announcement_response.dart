import 'dart:convert';

class ListAnnouncement {
  ListAnnouncement({
    this.message,
    this.status,
    this.code,
    this.data,
  });

  String message;
  bool status;
  int code;
  List<Announcement> data;

  factory ListAnnouncement.fromRawJson(String str) =>
      ListAnnouncement.fromJson(json.decode(str));

  String toRawJson() => json.encode(toJson());

  factory ListAnnouncement.fromJson(Map<String, dynamic> json) =>
      ListAnnouncement(
        message: json["message"] == null ? null : json["message"],
        status: json["status"] == null ? null : json["status"],
        code: json["code"] == null ? null : json["code"],
        data: json["data"] == null
            ? null
            : List<Announcement>.from(
                json["data"].map((x) => Announcement.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "message": message == null ? null : message,
        "status": status == null ? null : status,
        "code": code == null ? null : code,
        "data": data == null
            ? null
            : List<Announcement>.from(data.map((x) => x.toJson())),
      };
}

class Announcement {
  Announcement({
    this.id,
    this.title,
    this.thumbnail,
    this.description,
    this.latitude,
    this.longitude,
    this.createdAt,
    this.updatedAt,
    this.deletedAt,
    this.createdBy,
    this.updatedBy,
    this.deletedBy,
  });

  int id;
  String title;
  String thumbnail;
  String description;
  String latitude;
  String longitude;
  DateTime createdAt;
  DateTime updatedAt;
  dynamic deletedAt;
  int createdBy;
  int updatedBy;
  dynamic deletedBy;

  factory Announcement.fromRawJson(String str) =>
      Announcement.fromJson(json.decode(str));

  String toRawJson() => json.encode(toJson());

  factory Announcement.fromJson(Map<String, dynamic> json) => Announcement(
        id: json["id"] == null ? null : json["id"],
        title: json["title"] == null ? null : json["title"],
        thumbnail: json["thumbnail"] == null ? null : json["thumbnail"],
        description: json["description"] == null ? null : json["description"],
        latitude: json["latitude"] == null ? null : json["latitude"],
        longitude: json["longitude"] == null ? null : json["longitude"],
        createdAt: json["created_at"] == null
            ? null
            : DateTime.parse(json["created_at"]),
        updatedAt: json["updated_at"] == null
            ? null
            : DateTime.parse(json["updated_at"]),
        deletedAt: json["deleted_at"],
        createdBy: json["created_by"] == null ? null : json["created_by"],
        updatedBy: json["updated_by"] == null ? null : json["updated_by"],
        deletedBy: json["deleted_by"],
      );

  Map<String, dynamic> toJson() => {
        "id": id == null ? null : id,
        "title": title == null ? null : title,
        "thumbnail": thumbnail == null ? null : thumbnail,
        "description": description == null ? null : description,
        "latitude": latitude == null ? null : latitude,
        "longitude": longitude == null ? null : longitude,
        "created_at": createdAt == null ? null : createdAt.toIso8601String(),
        "updated_at": updatedAt == null ? null : updatedAt.toIso8601String(),
        "deleted_at": deletedAt,
        "created_by": createdBy == null ? null : createdBy,
        "updated_by": updatedBy == null ? null : updatedBy,
        "deleted_by": deletedBy,
      };
}
