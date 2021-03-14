import 'package:depokbersih/screens/articles.dart';
import 'package:depokbersih/screens/elements.dart';
import 'package:depokbersih/screens/home.dart';
import 'package:depokbersih/screens/login.dart';
// screens
import 'package:depokbersih/screens/onboarding.dart';
import 'package:depokbersih/screens/pro.dart';
import 'package:depokbersih/screens/profile.dart';
import 'package:depokbersih/screens/register.dart';
import 'package:flutter/material.dart';

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
        title: 'Argon PRO Flutter',
        theme: ThemeData(fontFamily: 'OpenSans'),
        initialRoute: "/onboarding",
        debugShowCheckedModeBanner: false,
        routes: <String, WidgetBuilder>{
          "/onboarding": (BuildContext context) => new OnBoardingScreen(),
          "/home": (BuildContext context) => new Home(),
          "/profile": (BuildContext context) => new Profile(),
          "/articles": (BuildContext context) => new Articles(),
          "/elements": (BuildContext context) => new Elements(),
          "/account": (BuildContext context) => new Register(),
          "/login": (BuildContext context) => new Login(),
          "/pro": (BuildContext context) => new Pro(),
        });
  }
}
