import 'package:depokbersih/response/announcement_response.dart';
import 'package:depokbersih/utils/api_service.dart';

class HomeRepository {
  static Future<ListAnnouncement> getAnnouncementAsync() async {
    final res = await ApiBaseHelper.postAsync(
      "/api/posts",
    );

    if (res.statusCode == 200) {
      return ListAnnouncement.fromJson(res.data);
    }

    throw ApiBaseHelper.createApiException(res);
  }
}
