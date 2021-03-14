import 'package:depokbersih/constants/Theme.dart';
import 'package:flutter/material.dart';

class Navbar extends StatefulWidget implements PreferredSizeWidget {
  final String title;
  final bool backButton;
  final bool transparent;
  final Function getCurrentPage;
  final bool isOnSearch;
  final bool noShadow;
  final Color bgColor;

  Navbar({
    this.title = "Home",
    this.transparent = false,
    this.getCurrentPage,
    this.isOnSearch = false,
    this.backButton = false,
    this.noShadow = false,
    this.bgColor = ArgonColors.white,
  });

  final double _prefferedHeight = 180.0;

  @override
  _NavbarState createState() => _NavbarState();

  @override
  Size get preferredSize => Size.fromHeight(_prefferedHeight);
}

class _NavbarState extends State<Navbar> {
  @override
  Widget build(BuildContext context) {
    return Container(
      height: 100,
      decoration: BoxDecoration(
        color: !widget.transparent ? widget.bgColor : Colors.transparent,
        boxShadow: [
          BoxShadow(
              color: !widget.transparent && !widget.noShadow
                  ? ArgonColors.initial
                  : Colors.transparent,
              spreadRadius: -10,
              blurRadius: 12,
              offset: Offset(0, 5))
        ],
      ),
      child: SafeArea(
        child: Padding(
          padding: const EdgeInsets.only(left: 16.0, right: 16.0),
          child: Row(
            children: [
              IconButton(
                  icon: Icon(
                      !widget.backButton ? Icons.menu : Icons.arrow_back_ios,
                      color: !widget.transparent
                          ? (widget.bgColor == ArgonColors.white
                              ? ArgonColors.initial
                              : ArgonColors.white)
                          : ArgonColors.white,
                      size: 24.0),
                  onPressed: () {
                    if (!widget.backButton)
                      Scaffold.of(context).openDrawer();
                    else
                      Navigator.pop(context);
                  }),
              Text(
                widget.title,
                style: TextStyle(
                  color: !widget.transparent
                      ? (widget.bgColor == ArgonColors.white
                          ? ArgonColors.initial
                          : ArgonColors.white)
                      : ArgonColors.white,
                  fontWeight: FontWeight.w600,
                  fontSize: 18.0,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
