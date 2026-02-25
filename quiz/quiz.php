<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #0f0f0f;
            min-height: 100vh;
            color: #f5f5f5;
        }

        .quiz-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .quiz-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #232023;
            border-radius: 12px;
            border: 1px solid rgba(139, 92, 246, 0.2);
        }

        .quiz-title {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(to right, #8b5cf6, #ec4899);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .stats-group {
            display: flex;
            gap: 12px;
        }

        .stat-box {
            background-color: #1a1a1a;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid rgba(139, 92, 246, 0.2);
            text-align: center;
            min-width: 100px;
        }

        .stat-label {
            color: #8b5cf6;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .stat-value {
            color: #f5f5f5;
            font-size: 24px;
            font-weight: 700;
        }

        /* Progress Bar */
        .progress-section {
            margin-bottom: 30px;
        }

        .progress-label {
            color: #b0b0b0;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background-color: #2c2c2c;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(to right, #8b5cf6, #ec4899);
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        /* Question Container */
        .question-container {
            background-color: #232023;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 20px;
            border: 1px solid rgba(139, 92, 246, 0.2);
        }

        .question-container.hidden {
            display: none;
        }

        .question-number {
            color: #8b5cf6;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .question-text {
            color: #f5f5f5;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .question-image {
            width: 100%;
            max-width: 400px;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
            margin: 0 auto 24px;
            display: block;
            background-color: #1a1a1a;
        }

        .question-image.hidden {
            display: none;
        }

        /* Options */
        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .option-button {
            padding: 16px;
            border: 2px solid rgba(139, 92, 246, 0.3);
            background-color: #1a1a1a;
            color: #f5f5f5;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
        }

        .option-button:hover:not(:disabled) {
            border-color: #8b5cf6;
            background-color: rgba(139, 92, 246, 0.1);
        }

        .option-button.selected {
            border-color: #8b5cf6;
            background: linear-gradient(to right, rgba(139, 92, 246, 0.3), rgba(236, 72, 153, 0.3));
            color: #fef3c7;
        }

        .option-button.correct {
            border-color: #10b981;
            background: linear-gradient(to right, rgba(16, 185, 129, 0.3), rgba(16, 185, 129, 0.2));
            color: #10b981;
        }

        .option-button.incorrect {
            border-color: #ef4444;
            background: linear-gradient(to right, rgba(239, 68, 68, 0.3), rgba(239, 68, 68, 0.2));
            color: #ef4444;
        }

        .option-button:disabled {
            cursor: not-allowed;
            opacity: 0.8;
        }

        /* Results Screen */
        .results-container {
            display: none;
            background-color: #232023;
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            border: 1px solid rgba(139, 92, 246, 0.2);
        }

        .results-container.active {
            display: block;
        }

        .score-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(to right, #8b5cf6, #ec4899);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 48px;
            font-weight: 700;
            color: white;
        }

        .results-title {
            font-size: 32px;
            font-weight: 700;
            color: #f5f5f5;
            margin-bottom: 12px;
        }

        .results-message {
            font-size: 18px;
            color: #b0b0b0;
            margin-bottom: 32px;
        }

        .results-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }

        .button-group-results {
            display: flex;
            gap: 12px;
        }

        .btn-retry,
        .btn-home {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-retry {
            background: linear-gradient(to right, #8b5cf6, #ec4899);
            color: white;
        }

        .btn-retry:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(139, 92, 246, 0.4);
        }

        .btn-home {
            border: 2px solid rgba(139, 92, 246, 0.3);
            background-color: transparent;
            color: #8b5cf6;
        }

        .btn-home:hover {
            border-color: #8b5cf6;
            background-color: rgba(139, 92, 246, 0.1);
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: #b0b0b0;
            font-size: 18px;
        }

        .loading.error {
            color: #ef4444;
        }

        @media (max-width: 768px) {
            .quiz-header {
                flex-direction: column;
                gap: 16px;
            }

            .stats-group {
                width: 100%;
                justify-content: space-around;
            }

            .options-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .results-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <!-- Quiz Header -->
        <div class="quiz-header">
            <h1 class="quiz-title">Quiz</h1>
            <div class="stats-group">
                <div class="stat-box">
                    <div class="stat-label">Score</div>
                    <div class="stat-value" id="scoreDisplay">0%</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Correct</div>
                    <div class="stat-value" id="correctCount">0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Wrong</div>
                    <div class="stat-value" id="wrongCount">0</div>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="progress-section">
            <div class="progress-label">
                <span id="progressText">Question 1 of 0</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill" style="width: 0%;"></div>
            </div>
        </div>

        <!-- Question Container -->
        <div class="question-container" id="questionContainer">
            <div class="question-number" id="questionNumber">Question 1</div>
            <div class="question-text" id="questionText">Loading...</div>
            <img id="questionImage" class="question-image hidden" src="" alt="Question Image">
            <div class="options-grid" id="optionsContainer"></div>
        </div>

        <!-- Loading/Error -->
        <div class="loading" id="loadingContainer" style="display: none;">
            <p id="loadingText">Loading quiz...</p>
        </div>

        <!-- Results Container -->
        <div class="results-container" id="resultsContainer">
            <div class="score-circle" id="scoreCircle">0%</div>
            <h2 class="results-title">Quiz Complete!</h2>
            <p class="results-message" id="resultsMessage"></p>
            
            <div class="results-stats">
                <div class="stat-box">
                    <div class="stat-label">Correct Answers</div>
                    <div class="stat-value" id="finalCorrectCount">0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Wrong Answers</div>
                    <div class="stat-value" id="finalWrongCount">0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Time Taken</div>
                    <div class="stat-value" id="timeTaken">0s</div>
                </div>
            </div>

            <div class="button-group-results">
                <button class="btn-retry" onclick="location.reload()">Retry Quiz</button>
            
            </div>
        </div>
    </div>

    <script>
        // Quiz State
        let quizData = [];
        let currentQuestion = 0;
        let score = 0;
        let selectedAnswer = null;
        let answered = false;
        let startTime = Date.now();

        // Shuffle Array (Fisher-Yates)
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        // Load Quiz Data from Database
        function loadQuizData() {
            fetch('quiz-api.php')
                .then(response => {
                    if (!response.ok) throw new Error('Failed to load quiz data');
                    return response.json();
                })
                .then(data => {
                    quizData = data;
                    if (quizData.length === 0) {
                        showError('No quiz questions found in database. Please import images first.');
                        return;
                    }
                    shuffleArray(quizData);
                    document.getElementById('loadingContainer').style.display = 'none';
                    document.getElementById('questionContainer').classList.remove('hidden');
                    initQuiz();
                })
                .catch(error => {
                    console.error('Error loading quiz:', error);
                    showError('Error loading quiz: ' + error.message);
                });
        }

        function showError(message) {
            const container = document.getElementById('loadingContainer');
            container.classList.add('error');
            container.style.display = 'block';
            document.getElementById('loadingText').textContent = message;
            document.getElementById('questionContainer').classList.add('hidden');
        }

        // Initialize Quiz
        function initQuiz() {
            loadQuestion();
        }

        // Load Question
        function loadQuestion() {
            if (currentQuestion >= quizData.length) {
                endQuiz();
                return;
            }

            const question = quizData[currentQuestion];
            selectedAnswer = null;
            answered = false;

            document.getElementById('questionNumber').textContent = `Question ${currentQuestion + 1}`;
            document.getElementById('progressText').textContent = `Question ${currentQuestion + 1} of ${quizData.length}`;
            document.getElementById('progressFill').style.width = `${((currentQuestion + 1) / quizData.length) * 100}%`;
            
            // Set question text
            document.getElementById('questionText').textContent = question.question || 'What is the correct answer?';
            
            // Load image if available
            const imgElement = document.getElementById('questionImage');
            if (question.imageId) {
                imgElement.src = `image.php?id=${question.imageId}`;
                imgElement.classList.remove('hidden');
                imgElement.alt = `Question ${currentQuestion + 1} image`;
            } else {
                imgElement.classList.add('hidden');
            }

            // Render options
            renderOptions(question);
        }

        // Render Options
        function renderOptions(question) {
            const container = document.getElementById('optionsContainer');
            container.innerHTML = '';

            if (!question.options || question.options.length === 0) {
                container.innerHTML = '<p style="color: #ef4444;">No options available for this question</p>';
                return;
            }

            // Shuffle options
            const options = [...question.options];
            options.sort(() => Math.random() - 0.5);

            options.forEach((option, idx) => {
                const button = document.createElement('button');
                button.className = 'option-button';
                button.textContent = `${option.key}. ${option.text}`;
                button.dataset.correct = option.correct ? 'true' : 'false';
                button.onclick = () => selectOption(button, option);
                container.appendChild(button);
            });
        }

        // Select Option
        function selectOption(button, option) {
            if (answered) return;

            selectedAnswer = option;
            answered = true;

            const buttons = document.querySelectorAll('.option-button');
            buttons.forEach(btn => btn.disabled = true);

            const question = quizData[currentQuestion];
            const isCorrect = option.correct || (question.correct && question.correct === option.key);

            if (isCorrect) {
                button.classList.add('correct');
                score++;
            } else {
                button.classList.add('incorrect');
                // Show correct answer
                buttons.forEach(btn => {
                    if (btn.dataset.correct === 'true') {
                        btn.classList.add('correct');
                    }
                });
            }

            // Update stats
            updateStats();

            // Auto-advance to next question after 3 seconds
            setTimeout(() => {
                currentQuestion++;
                loadQuestion();
            }, 3000);
        }

        // Update Statistics Display
        function updateStats() {
            const correct = score;
            const wrong = currentQuestion + 1 - score;
            const percentage = quizData.length > 0 ? Math.round((score / quizData.length) * 100) : 0;
            
            document.getElementById('scoreDisplay').textContent = percentage + '%';
            document.getElementById('correctCount').textContent = correct;
            document.getElementById('wrongCount').textContent = wrong;
        }

        // End Quiz
        function endQuiz() {
            const timeTaken = Math.floor((Date.now() - startTime) / 1000);
            const percentage = quizData.length > 0 ? Math.round((score / quizData.length) * 100) : 0;

            document.getElementById('questionContainer').classList.add('hidden');
            document.getElementById('resultsContainer').classList.add('active');

            // Update results
            document.getElementById('scoreCircle').textContent = `${percentage}%`;
            document.getElementById('finalCorrectCount').textContent = score;
            document.getElementById('finalWrongCount').textContent = quizData.length - score;
            document.getElementById('timeTaken').textContent = `${timeTaken}s`;

            if (percentage >= 80) {
                document.getElementById('resultsMessage').textContent = 'Excellent! You passed with flying colors! 🎉';
            } else if (percentage >= 60) {
                document.getElementById('resultsMessage').textContent = 'Good job! You passed the quiz! 👍';
            } else {
                document.getElementById('resultsMessage').textContent = 'Keep practicing! You\'ll do better next time. 💪';
            }
        }

        // Initialize on load
        window.addEventListener('DOMContentLoaded', loadQuizData);
    </script>
</body>
</html>
