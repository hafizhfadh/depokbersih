import 'package:depokbersih/screens/home.dart';
import 'package:flutter/material.dart';

class CardUser extends StatelessWidget {
  final UserProfile profile;

  const CardUser({Key key, this.profile}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return Container(
      height: 150.0,
      decoration: BoxDecoration(
        color: Color(0xFF333366),
        shape: BoxShape.rectangle,
        borderRadius: BorderRadius.circular(8.0),
        boxShadow: <BoxShadow>[
          BoxShadow(
            color: Colors.black12,
            blurRadius: 10.0,
            offset: Offset(0.0, 10.0),
          ),
        ],
      ),
      child: Container(
        margin: EdgeInsets.fromLTRB(76.0, 16.0, 16.0, 16.0),
        constraints: BoxConstraints.expand(),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            Container(height: 4.0),
            Text(
              "${profile.name}",
              style: TextStyle(
                color: Colors.white,
                fontSize: 18.0,
                fontWeight: FontWeight.w600,
              ),
            ),
            Container(height: 10.0),
            Text("${profile.group}", style: TextStyle(fontSize: 12.0)),
            Container(
                margin: EdgeInsets.symmetric(vertical: 8.0),
                height: 2.0,
                width: 18.0,
                color: Color(0xff00c6ff)),
            Row(
              children: <Widget>[
                Icon(Icons.location_on_outlined),
                Container(width: 8.0),
                Text(
                  "DISTANCE",
                  style: TextStyle(
                      color: Color(0xffb6b2df),
                      fontSize: 9.0,
                      fontWeight: FontWeight.w400),
                ),
                Container(width: 24.0),
                Icon(Icons.workspaces_outline),
                Container(width: 8.0),
                Text(
                  "GRAVITY",
                  style: TextStyle(
                      color: Color(0xffb6b2df),
                      fontSize: 9.0,
                      fontWeight: FontWeight.w400),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }
}
