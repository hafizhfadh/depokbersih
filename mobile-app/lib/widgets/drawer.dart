import 'package:depokbersih/constants/Theme.dart';
import 'package:depokbersih/widgets/drawer-tile.dart';
import 'package:flutter/material.dart';

class ArgonDrawer extends StatelessWidget {
  final String currentPage;

  ArgonDrawer({this.currentPage});

  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: Container(
        color: ArgonColors.white,
        child: Flex(
          direction: Axis.vertical,
          children: [
            Expanded(
                flex: 1,
                child: SafeArea(
                  bottom: false,
                  child: Align(
                    alignment: Alignment.bottomLeft,
                    child: Padding(
                      padding: const EdgeInsets.only(left: 32),
                      child: Text(
                        "DEPOKBERSIH",
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                          fontSize: 20,
                          color: ArgonColors.primary,
                        ),
                      ),
                    ),
                  ),
                )),
            Expanded(
              flex: 10,
              child: ListView(
                padding: EdgeInsets.only(top: 24, left: 16, right: 16),
                children: [
                  DrawerTile(
                      icon: Icons.home,
                      onTap: () {
                        if (currentPage != "Home")
                          Navigator.pushReplacementNamed(context, '/home');
                      },
                      iconColor: ArgonColors.primary,
                      title: "Home",
                      isSelected: currentPage == "Home" ? true : false),
                  DrawerTile(
                      icon: Icons.pie_chart,
                      onTap: () {
                        if (currentPage != "Profile")
                          Navigator.pushReplacementNamed(context, '/profile');
                      },
                      iconColor: ArgonColors.warning,
                      title: "Profile",
                      isSelected: currentPage == "Profile" ? true : false),
                  DrawerTile(
                      icon: Icons.apps,
                      onTap: () {
                        if (currentPage != "Articles")
                          Navigator.pushReplacementNamed(context, '/articles');
                      },
                      iconColor: ArgonColors.primary,
                      title: "Articles",
                      isSelected: currentPage == "Articles" ? true : false),
                ],
              ),
            ),
            Expanded(
              flex: 1,
              child: Container(
                padding: EdgeInsets.only(left: 8, right: 16),
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.start,
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Divider(height: 4, thickness: 0, color: ArgonColors.muted),
                    DrawerTile(
                        icon: Icons.lock_outline,
                        onTap: () {
                          if (currentPage != "Logout")
                            Navigator.pushReplacementNamed(context, '/login');
                        },
                        iconColor: ArgonColors.primary,
                        title: "Logout",
                        isSelected: currentPage == "Logout" ? true : false),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
