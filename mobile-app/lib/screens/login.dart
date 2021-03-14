import 'dart:ui';

import 'package:depokbersih/constants/Theme.dart';
import 'package:depokbersih/repositories/auth_repo.dart';
import 'package:depokbersih/request/auth_request.dart';
import 'package:depokbersih/response/auth_response.dart';
import 'package:flutter/material.dart';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';

class Login extends StatefulWidget {
  @override
  _LoginState createState() => _LoginState();
}

class _LoginState extends State<Login> {
  final _emailEditingController = TextEditingController();
  final _passwordEditingController = TextEditingController();
  FlutterSecureStorage _storage = FlutterSecureStorage();

  Future<void> doLogin() async {
    try {
      LoginRequest request = LoginRequest()
        ..email = _emailEditingController.text
        ..password = _passwordEditingController.text;
      LoginResponse response = await AuthRepository.loginAsync(request);
      if (response.token != null) {
        await _storage.write(key: "TOKEN", value: response.token);
        await _storage.write(key: "NAME", value: response.name);
        await _storage.write(key: "EMAIL", value: response.email);
        await _storage.write(key: "GROUP", value: response.groups.first.name);
        await Navigator.pushReplacementNamed(context, '/home');
      }
    } catch (e) {
      print(e);
    }
  }

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
          SingleChildScrollView(
            child: Container(
              padding: EdgeInsets.only(
                  top: 240, left: 24.0, right: 24.0, bottom: 240),
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
                        child: Text("Login",
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
                          child: TextField(
                            controller: _emailEditingController,
                            keyboardType: TextInputType.emailAddress,
                            onSubmitted: (value) {
                              _passwordEditingController.text = value;
                            },
                            decoration: InputDecoration(
                              border: OutlineInputBorder(
                                borderSide: BorderSide(width: 5.0),
                              ),
                              labelText: "Input Email Here...",
                              errorText: _emailEditingController.text == null
                                  ? 'Email Can\'t Be Empty'
                                  : null,
                              prefixIcon: Icon(Icons.email),
                            ),
                          ),
                        ),
                        Padding(
                          padding: const EdgeInsets.all(8.0),
                          child: TextField(
                            controller: _passwordEditingController,
                            onSubmitted: (value) {
                              _passwordEditingController.text = value;
                            },
                            obscureText: true,
                            decoration: InputDecoration(
                              border: OutlineInputBorder(
                                borderSide: BorderSide(width: 5.0),
                              ),
                              labelText: "Input Password Here...",
                              errorText: _passwordEditingController.text == null
                                  ? 'Password Can\'t Be Empty'
                                  : null,
                              prefixIcon: Icon(Icons.lock),
                            ),
                          ),
                        ),
                      ],
                    ),
                    Padding(
                      padding: EdgeInsets.only(top: 16, bottom: 16),
                      child: Center(
                        child: FlatButton(
                          textColor: ArgonColors.white,
                          color: ArgonColors.primary,
                          onPressed: () => doLogin(),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(4.0),
                          ),
                          child: Padding(
                            padding: EdgeInsets.only(
                                left: 16.0, right: 16.0, top: 12, bottom: 12),
                            child: Text(
                              "LOGIN",
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
          ),
        ],
      ),
    );
  }
}
