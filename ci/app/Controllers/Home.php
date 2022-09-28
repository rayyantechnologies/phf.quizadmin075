<?php

namespace App\Controllers;
    use Goodby\CSV\Import\Standard\Lexer;
    use Goodby\CSV\Import\Standard\Interpreter;
    use Goodby\CSV\Import\Standard\LexerConfig;


class Home extends BaseController
{
	public function index()
	{
		$session = session();
		if ($session->logged_in == TRUE) {
			$session = session();
			if ($session->clearance == 11) {
				return redirect()->to('db');
			}
		} else {
			$this->login();
		}
	}


	public function login()
	{
		echo view('login');
	}

	public function cards()
	{
		$var = new \App\Models\Variables();
		$scoresheet = new \App\Models\Scoresheet();
		$user = new \App\Models\Users();
		$session = session();
		if ($session->logged_in == TRUE) {
			$data = [
				'quizinput' => $var->where('key', 'quizinput')->find()[0]['value'],
				'quizparticipants' => count($scoresheet->where('sent', '0')->find()),
				'score' => $scoresheet->join('users', 'users.id = scoresheet.user')->findAll(),
				'users' => $user->where('clearance', '1')->findAll(),
			];

			echo view('header');
			echo view('sidebar');
			echo view('cards');
		} else {
			$this->login();
		}
	}


	public function postlogin()
	{
		$users = new \App\Models\Users();
		$incoming = $this->request->getPost();
		$data = [
			'email' => $incoming['email'],
			'password' => hash('md5', $incoming['password']),
			// 'password' => $incoming['password']
		];
		$result = $users->where($data)->find();
		if ($result) {
			if ($result[0]['clearance'] == 11) {
				$ses_data = [
					'id' => $result[0]['id'],
					'clearance' => $result[0]['clearance'],
					'logged_in' => TRUE,
				];
				$session = session();
				$session->set($ses_data);
				return redirect()->to('db');
			}
		} else {
			echo 'Login not Successful';
		}
	}

	public function quizinput()
	{
		$var = new \App\Models\Variables();
		$session = session();
		if ($session->logged_in == TRUE) {
			$db = $var->where('key', 'quizinput')->find()[0]['value'];
			if ($db == 'disabled') {
				$data = [
					'value' => '',
				];
				$var->update(2, $data);
			} else if ($db == '') {
				$data = [
					'value' => 'disabled',
				];
				$var->update(2, $data);
			}
			return redirect()->to('db');
		} else {
			echo 'Login not Successful';
		}
	}

	public function msg(array $data)
	{
		echo view('msg', $data);
	}

	public function dashboard($quizid = 0)
	{
		$var = new \App\Models\Variables();
		$Quiz = new \App\Models\Quiz();
		$scoresheet = new \App\Models\Scoresheet();
		$user = new \App\Models\Users();
		$session = session();
		$qlast = $quizid ? $quizid : $Quiz->orderBy('id', 'desc')->first()['id'];
		if ($session->logged_in == TRUE) {
			$data = [
				'quizinput' => $var->where('key', 'quizinput')->find()[0]['value'],
				'quiz' => $Quiz->findAll(),
				'quizparticipants' => count($scoresheet->where('sent', '0')->find()),
				'score' => $scoresheet->join('users', 'users.id = scoresheet.user')->where('quiz', $qlast)->findAll(),
				'users' => $user->where('clearance', '1')->findAll(),
			];

			echo view('header');
			echo view('sidebar');
			echo view('db', $data);
		} else {
			$this->login();
		}
	}

	public function getscoresheet()
	{	
		$incoming = $this->request->getPost('scoresheet');
		$this->dashboard($incoming);
	}

	public function questions()
	{
		$quiz = new \App\Models\Quiz();
		$session = session();
		if ($session->logged_in == TRUE) {
			$data = [
				'noq' => range(1, 15),
				'quiz' => $quiz->findAll(),
			];
			echo view('header');
			echo view('sidebar');
			echo view('questions', $data);
		} else {
			$this->login();
		}
	}


    public function ssquestions()
    {
        $quiz = new \App\Models\Quiz();
        $session = session();
        if ($session->logged_in == TRUE) {
            $data = [
                'noq' => range(1, 15),
                'quiz' => $quiz->findAll(),
            ];
            echo view('header');
            echo view('sidebar');
            echo view('squestions', $data);
        } else {
            $this->login();
        }
    }

	public function editquestions()
	{
		$id = $this->request->getGet('id');
		$quiz = new \App\Models\Quiz();
		$session = session();
		if ($session->logged_in == TRUE) {
			$res = $quiz->where('id', $id)->find();
			$data = [
				'noq' => range(1, 15),
				'zero' => 0,
				'one' => 1,
				'two' => 2,
				'three' => 3,
				'four' => 4,
				'quiz' => $quiz->findAll(),
				'prefill' => $res[0],
				'quest' => json_decode($res[0]['questions']),
				'answer' => json_decode($res[0]['answers']),
			];
			echo view('header');
			echo view('sidebar');
			echo view('questions2', $data);
		} else {
			$this->login();
		}
	}

	public function postquestions()
	{
		$session = session();
		$quiz = new \App\Models\Quiz();
		if ($session->logged_in == TRUE) {
			$incoming = $this->request->getPost();
			$incoming['code'] = array($incoming['code']);
			$incoming['title'] = array($incoming['title']);
			$incoming['description'] = array($incoming['description']);
			$quest = [];
			$answer = [];
			$count = 0;
			foreach ($incoming as $key => $value) {
				if (count($value) > 3) {
					$count++;
					$output = [
						'id' => $count,
						'0' => $value['0'],
						'1' => $value['1'],
						'2' => $value['2'],
						'3' => $value['3'],
						'4' => $value['4']
					];
					$output2 = [
						'id' => $count,
						'ans' => $value['5']
					];
					array_push($quest, $output);
					array_push($answer, $output2);
				} else {
					echo "";
				}
				// var_dump($quest);
				// var_dump($value);
			}
			$data = [
				'code' => $incoming['code'],
				'title' => $incoming['title'],
				'description' => $incoming['description'],
				'published' => 0,
				'questions' => array(json_encode($quest)),
				'answers' => array(json_encode($answer)),
			];
			$res = $quiz->insert($data);
			if ($res) {
				$this->msg(['msg' => "New Quiz uploaded successfully"]);
			}
		} else {
			$this->login();
		}
	}

    public function postquestionss()
    {
        $session = session();
        $quiz = new \App\Models\Quiz();

        if ($session->logged_in == TRUE) {
            $incoming = $this->request->getPost();
            $file = $this->request->getFile('quiz')->store();

            $rows = $this->reader($file);
            // var_dump($rows);
            // foreach ($rows as $key => $row) {
            //     var_dump($row);
            //    }

            $incoming['code'] = array($incoming['code']);
            $incoming['title'] = array($incoming['title']);
            $incoming['description'] = array($incoming['description']);
            $quest = [];
            $answer = [];
            $count = 0;
            foreach ($rows as $key => $value) {
                if ($key == 0) {
                    continue;
                }
                    $count++;
                    $output = [
                        'id' => $count,
                        '0' => $value['0'],
                        '1' => $value['1'],
                        '2' => $value['2'],
                        '3' => $value['3'],
                        '4' => $value['4']
                    ];
                    $output2 = [
                        'id' => $count,
                        'ans' => $value['5']
                    ];
                    array_push($quest, $output);
                    array_push($answer, $output2);
                // } else {
                //     echo "";
                // }
                // var_dump($quest);
                // var_dump($value);
            }
            $data = [
                'code' => $incoming['code'],
                'title' => $incoming['title'],
                'description' => $incoming['description'],
                'published' => 0,
                'questions' => array(json_encode($quest)),
                'answers' => array(json_encode($answer)),
            ];
            $res = $quiz->insert($data);
            if ($res) {
                $this->msg(['msg' => "New Quiz uploaded successfully"]);
            }
        } else {
            $this->login();
        }
    }

	public function updatequestions()
	{
		$session = session();
		$quiz = new \App\Models\Quiz();
		if ($session->logged_in == TRUE) {
			$incoming = $this->request->getPost();
			$incoming['code'] = array($incoming['code']);
			$incoming['id'] = array($incoming['id']);
			$incoming['title'] = array($incoming['title']);
			$incoming['description'] = array($incoming['description']);
			$quest = [];
			$answer = [];
			$count = 0;
			foreach ($incoming as $key => $value) {
				if (count($value) > 3) {
					$count++;
					$output = [
						'id' => $count,
						'0' => $value['0'],
						'1' => $value['1'],
						'2' => $value['2'],
						'3' => $value['3'],
						'4' => $value['4']
					];
					$output2 = [
						'id' => $count,
						'ans' => $value['5']
					];
					array_push($quest, $output);
					array_push($answer, $output2);
				} else {
					echo "";
				}
			}
			$data = [
				'code' => $incoming['code'],
				'title' => $incoming['title'],
				'description' => $incoming['description'],
				'published' => 0,
				'questions' => array(json_encode($quest)),
				'answers' => array(json_encode($answer)),
			];
			$id = $incoming['id'];
			$res = $quiz->update($id, $data);
			if ($res) {
				$this->msg(['msg' => "Quiz updated successfully"]);
			}
		} else {
			$this->login();
		}
	}

    private function reader($file){

        $rows = array();

        $config = new LexerConfig();
        $lexer = new Lexer($config);

        $interpreter = new Interpreter();

        $interpreter->addObserver(function(array $row) use(&$rows){
             $rows[] = $row;
        });

        $lexer->parse(WRITEPATH . 'uploads/'.$file, $interpreter);



        // $rows = SimpleExcelReader::create(WRITEPATH . 'uploads/'.$file)
        // ->noHeaderRow(['q', 'oa','ob','oc','od','a'])
        // ->getRows();
            // var_dump($rows);

        return $rows;

    }

    public function testss()
    {
        $rows = SimpleExcelReader::create('quiz.xlsx')
        ->noHeaderRow(['q', 'oa','ob','oc','od','a'])
        ->getRows()
        ->each(function(array $rowProperties) {
           var_dump($rowProperties);
        });
    }

	public function test($code, $do)
	{
		if ($do) {
			$key = ' !u^e_%a#t@';
			$pos = str_split($code);
			$res = '';
			foreach ($pos as $ky => $ps) {
				$res = $res . str_split($key)[$ps];
			}
			return urlencode($res);
		} else {
			$key = ' !u^e_%a#t@';
			$pos = urldecode($code);
			$res = '';
			$pos = str_split($pos);
			$key = str_split($key);
			foreach ($pos as $k => $os) {
				foreach ($key as $ky => $ps) {
					if ($pos[$k] == $ps)
						$res = $res . $ky;
				}
			}
			return $res;
		}
	}


	public function sendscores($quizid = 0)
	{
		$session = session();
		if ($session->logged_in == TRUE) {
			$scoresheet = new \App\Models\Scoresheet();
			$users = new \App\Models\Users();
			$Quiz = new \App\Models\Quiz();
			$qlast = $quizid ? $quizid :  $Quiz->orderBy('id', 'desc')->first()['code'];
			$res = $scoresheet->where('sent', '0')->find();
	
			$coo = $this->test($qlast,1);
			foreach ($res as $key => $rs) {
				$db = $users->where('id', $rs['user'])->find();
				$data = [
					'to' => $db[0]['email'],
					'type' => 'link',
					'subject' => 'Score Released - PHF Ogun Quiz',
					'message' => ['p1' => 'Your score has been released for PHF Ogun Monthly Quiz', 'p2'=>'Your Score is '.$rs['score'].'/15.', 'p3' => 'Do join us next Month for another exciting edition.', 'link'=>'https://quiz.phfogun.org/solution/'.$coo.'', 'linktext'=>'Click here for answers to the questions'],
					'response' => [
						'title' => 'Scores Sent',
						'msg' => 'All scores has been sent out to the provided email',
						'url' => base_url('login'),
					]
				];
				if ($this->mailer($data)) {
					$scoresheet->update($rs['id'], ['sent' => '1']);
				}
			}
			$this->msg([
				'title' => 'Scores Sent',
				'msg' => 'All scores has been sent out to the provided email',
				'url' => base_url('login'),
			]);
		} else {
			$this->login();
		}
	}

	public function mailer(array $data)
	{
		$email = \Config\Services::email();
		$email->setFrom('quiz@phfogun.org', 'PHF Quiz Master');
		$email->setTo($data['to']);
		// $email->setCC('another@another-example.com');
		// $email->setBCC('them@their-example.com');

		$email->setSubject($data['subject']);
		$email->setMessage($this->message($data['type'], $data['message']));

		if ($email->send()) {
			return 1;
		} else {
			return 0;
		}
		// $this->msg($data['response']);

		echo $email->printDebugger(['headers', 'subject', 'body']);
	}


	public function message($type, $data)
	{
		// $data params
		// 	p1 -- Paragraph 1
		// 	p2 -- Paragraph 2
		// 	p3 -- Paragraph 3
		// 	link -- href link
		// 	linktext -- Display Text

		if ($type == 'link') {
			$output = "
            <!doctype html>
			<html>
			<head>
				<meta name='viewport' content='width=device-width'>
				<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
				<title>PHF Quiz</title>
				<style>
					@media only screen and (max-width: 620px) {
					table[class=body] h1 {
						font-size: 28px !important;
						margin-bottom: 10px !important;
					}

					table[class=body] p,
					table[class=body] ul,
					table[class=body] ol,
					table[class=body] td,
					table[class=body] span,
					table[class=body] a {
						font-size: 16px !important;
					}

					table[class=body] .wrapper,
					table[class=body] .article {
						padding: 10px !important;
					}

					table[class=body] .content {
						padding: 0 !important;
					}

					table[class=body] .container {
						padding: 0 !important;
						width: 100% !important;
					}

					table[class=body] .main {
						border-left-width: 0 !important;
						border-radius: 0 !important;
						border-right-width: 0 !important;
					}

					table[class=body] .btn table {
						width: 100% !important;
					}

					table[class=body] .btn a {
						width: 100% !important;
					}

					table[class=body] .img-responsive {
						height: auto !important;
						max-width: 100% !important;
						width: auto !important;
					}
					}
					@media all {
					.ExternalClass {
						width: 100%;
					}

					.ExternalClass,
					.ExternalClass p,
					.ExternalClass span,
					.ExternalClass font,
					.ExternalClass td,
					.ExternalClass div {
						line-height: 100%;
					}

					.apple-link a {
						color: inherit !important;
						font-family: inherit !important;
						font-size: inherit !important;
						font-weight: inherit !important;
						line-height: inherit !important;
						text-decoration: none !important;
					}

					#MessageViewBody a {
						color: inherit;
						text-decoration: none;
						font-size: inherit;
						font-family: inherit;
						font-weight: inherit;
						line-height: inherit;
					}

					.btn-primary table td:hover {
						background-color: #34495e !important;
					}

					.btn-primary a:hover {
						background-color: #34495e !important;
						border-color: #34495e !important;
					}
					}
				</style>
			</head>
			<body class='' style='background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
				<span class='preheader' style='color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;'>" . substr($data['p1'], 0, 70) . "</span>
				<table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;' width='100%' bgcolor='#f6f6f6'>
				<tr>
					<td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
					<td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
					<div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>

						<!-- START CENTERED WHITE CONTAINER -->
						<table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>

						<!-- START MAIN CONTENT AREA -->
						<tr>
							<td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
							<table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;' width='100%'>
								<tr>
								<td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
									<p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi there,</p>
									<p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>" . $data['p1'] . "</p>
									<table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%;' width='100%'>
									<tbody>
										<tr>
										<td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
											<table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;'>
											<tbody>
												<tr>
												<td style='font-family: sans-serif; font-size: 14px; vertical-align: top; border-radius: 5px; text-align: center; background-color: #3498db;' valign='top' align='center' bgcolor='#3498db'> <a href='" . $data['link'] . "' target='_blank' style='border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #3498db; border-color: #3498db; color: #ffffff;'>" . $data['linktext'] . "</a> </td>
												</tr>
											</tbody>
											</table>
										</td>
										</tr>
									</tbody>
									</table>
									<p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>" . $data['p2'] . "</p>
									<p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>" . $data['p3'] . "</p>
								</td>
								</tr>
							</table>
							</td>
						</tr>

						<!-- END MAIN CONTENT AREA -->
						</table>
						<!-- END CENTERED WHITE CONTAINER -->

						<!-- START FOOTER -->
						<div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
						<table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;' width='100%'>
							<tr>
							<td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;' valign='top' align='center'>
								<span class='apple-link' style='color: #999999; font-size: 12px; text-align: center;'>Pure Heart Islamic Foundation, Ogun State</span>
								
							</td>
							</tr>
							<tr>
							<td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;' valign='top' align='center'>
								
							</td>
							</tr>
						</table>
						</div>
						<!-- END FOOTER -->

					</div>
					</td>
					<td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
				</tr>
				</table>
			</body>
			</html>
        ";
		} else if ($type == 'text') {
			// Just one p1
			$output = "
            <!doctype html>
			<html>
			<head>
				<meta name='viewport' content='width=device-width'>
				<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
				<title>PHF Quiz</title>
				<style>
					@media only screen and (max-width: 620px) {
					table[class=body] h1 {
						font-size: 28px !important;
						margin-bottom: 10px !important;
					}

					table[class=body] p,
					table[class=body] ul,
					table[class=body] ol,
					table[class=body] td,
					table[class=body] span,
					table[class=body] a {
						font-size: 16px !important;
					}

					table[class=body] .wrapper,
					table[class=body] .article {
						padding: 10px !important;
					}

					table[class=body] .content {
						padding: 0 !important;
					}

					table[class=body] .container {
						padding: 0 !important;
						width: 100% !important;
					}

					table[class=body] .main {
						border-left-width: 0 !important;
						border-radius: 0 !important;
						border-right-width: 0 !important;
					}

					table[class=body] .btn table {
						width: 100% !important;
					}

					table[class=body] .btn a {
						width: 100% !important;
					}

					table[class=body] .img-responsive {
						height: auto !important;
						max-width: 100% !important;
						width: auto !important;
					}
					}
					@media all {
					.ExternalClass {
						width: 100%;
					}

					.ExternalClass,
					.ExternalClass p,
					.ExternalClass span,
					.ExternalClass font,
					.ExternalClass td,
					.ExternalClass div {
						line-height: 100%;
					}

					.apple-link a {
						color: inherit !important;
						font-family: inherit !important;
						font-size: inherit !important;
						font-weight: inherit !important;
						line-height: inherit !important;
						text-decoration: none !important;
					}

					#MessageViewBody a {
						color: inherit;
						text-decoration: none;
						font-size: inherit;
						font-family: inherit;
						font-weight: inherit;
						line-height: inherit;
					}

					.btn-primary table td:hover {
						background-color: #34495e !important;
					}

					.btn-primary a:hover {
						background-color: #34495e !important;
						border-color: #34495e !important;
					}
					}
				</style>
			</head>
			<body class='' style='background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
				<span class='preheader' style='color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;'>" . substr($data['p1'], 0, 70) . "</span>
				<table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;' width='100%' bgcolor='#f6f6f6'>
				<tr>
					<td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
					<td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
					<div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>

						<!-- START CENTERED WHITE CONTAINER -->
						<table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>

						<!-- START MAIN CONTENT AREA -->
						<tr>
							<td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
							<table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;' width='100%'>
								<tr>
								<td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
									<p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi there,</p>
									<p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>" . $data['p1'] . "</p>
								</td>
								</tr>
							</table>
							</td>
						</tr>

						<!-- END MAIN CONTENT AREA -->
						</table>
						<!-- END CENTERED WHITE CONTAINER -->

						<!-- START FOOTER -->
						<div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
						<table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;' width='100%'>
							<tr>
							<td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;' valign='top' align='center'>
								<span class='apple-link' style='color: #999999; font-size: 12px; text-align: center;'>Pure Heart Islamic Foundation, Ogun State</span>
								
							</td>
							</tr>
							<tr>
							<td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;' valign='top' align='center'>
								
							</td>
							</tr>
						</table>
						</div>
						<!-- END FOOTER -->

					</div>
					</td>
					<td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
				</tr>
				</table>
			</body>
			</html>
        ";
		}
		return $output;
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url());
	}

	//--------------------------------------------------------------------

}
