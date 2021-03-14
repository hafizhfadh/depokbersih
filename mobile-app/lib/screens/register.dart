import 'dart:ui';

import 'package:depokbersih/constants/Theme.dart';
import 'package:depokbersih/widgets/input.dart';
import 'package:flutter/material.dart';

class Register extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          Container(
            decoration: BoxDecoration(
              image: DecorationImage(
                  image: AssetImage("assets/img/register-bg.png"),
                  fit: BoxFit.cover),
            ),
          ),
          Container(
            padding:
                EdgeInsets.only(top: 200, left: 24.0, right: 24.0, bottom: 200),
            child: Card(
              elevation: 5,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(4.0),
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Padding(
                    padding: const EdgeInsets.only(top: 24.0, bottom: 24.0),
                    child: Center(
                      child: Text("Join With Us",
                          style: TextStyle(
                              color: ArgonColors.text,
                              fontWeight: FontWeight.bold,
                              fontSize: 30)),
                    ),
                  ),
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Input(
                          placeholder: "Name",
                          prefixIcon: Icon(Icons.school),
                        ),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Input(
                            placeholder: "Email",
                            prefixIcon: Icon(Icons.email)),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Input(
                            placeholder: "Password",
                            prefixIcon: Icon(Icons.lock)),
                      ),
                    ],
                  ),
                  Padding(
                    padding: EdgeInsets.only(top: 16),
                    child: Center(
                      child: FlatButton(
                        textColor: ArgonColors.white,
                        color: ArgonColors.primary,
                        onPressed: () {
                          // Respond to button press
                          Navigator.pushReplacementNamed(context, '/home');
                        },
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(4.0),
                        ),
                        child: Padding(
                          padding: EdgeInsets.only(
                              left: 16.0, right: 16.0, top: 12, bottom: 12),
                          child: Text(
                            "REGISTER",
                            style: TextStyle(
                                fontWeight: FontWeight.w600, fontSize: 16.0),
                          ),
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
