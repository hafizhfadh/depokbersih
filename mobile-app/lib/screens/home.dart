import 'package:depokbersih/constants/Theme.dart';
import 'package:depokbersih/repositories/home_repo.dart';
import 'package:depokbersih/response/announcement_response.dart';
import 'package:depokbersih/widgets/card-horizontal.dart';
import 'package:depokbersih/widgets/card-small.dart';
import 'package:depokbersih/widgets/card-user.dart';
import 'package:depokbersih/widgets/drawer.dart';
//widgets
import 'package:depokbersih/widgets/navbar.dart';
import 'package:flutter/material.dart';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';

class UserProfile {
  final String name;
  final String email;
  final String group;

  UserProfile({this.name = "NAME", this.email = "EMAIL", this.group = "GROUP"});
}

class Home extends StatefulWidget {
  @override
  _HomeState createState() => _HomeState();
}

class _HomeState extends State<Home> {
  ListAnnouncement _listAnnouncement;
  UserProfile _profile;
  FlutterSecureStorage _storage = FlutterSecureStorage();
  getAnnouncement() async {
    _profile = UserProfile(
      name: await _storage.read(key: "NAME"),
      email: await _storage.read(key: "EMAIL"),
      group: await _storage.read(key: "GROUP"),
    );
    try {
      _listAnnouncement = await HomeRepository.getAnnouncementAsync();
    } catch (e) {
      print(e);
    }
  }

  @override
  void initState() {
    getAnnouncement();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: Navbar(
        title: "Home",
      ),
      backgroundColor: ArgonColors.bgColorScreen,
      // key: _scaffoldKey,
      drawer: ArgonDrawer(currentPage: "Home"),
      body: Column(
        children: [
          CardUser(
            profile: _profile,
          ),
          Container(
            height: 573,
            padding: EdgeInsets.only(left: 24.0, right: 24.0),
            child: ListView.builder(
                itemCount: _listAnnouncement == null
                    ? 0
                    : _listAnnouncement.data.length,
                itemBuilder: (BuildContext context, int index) {
                  if (_listAnnouncement == null) {
                    return Center(
                      child: CircularProgressIndicator(),
                    );
                  } else {
                    if (index == 0) {
                      return CardSmall(
                          cta: "View article",
                          title: _listAnnouncement.data[index].title,
                          img: _listAnnouncement.data[index].thumbnail,
                          tap: () {
                            Navigator.pushNamed(context, '/pro');
                          });
                    }
                    return CardHorizontal(
                        cta: "View article",
                        title: _listAnnouncement.data[index].title,
                        img: _listAnnouncement.data[index].thumbnail,
                        tap: () {
                          Navigator.pushNamed(context, '/pro');
                        });
                  }
                }),
          ),
        ],
      ),
    );
  }
}
