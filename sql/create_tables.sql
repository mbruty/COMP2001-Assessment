DROP TABLE IF EXISTS [dbo].[Sessions];
DROP TABLE IF EXISTS [dbo].[Passwords];
DROP TABLE IF EXISTS [dbo].[Users];
GO

CREATE TABLE [Users] (
    [user_id] INT IDENTITY(1,1) PRIMARY KEY,
    [first_name] NVARCHAR(50),
    [last_name] NVARCHAR(50),
    [email] NVARCHAR(50) UNIQUE,
    [password] VARBINARY(8000),
);



CREATE TABLE [Passwords] (
    [password_id] INT IDENTITY(1,1) PRIMARY KEY,
    [user_id] INT FOREIGN KEY REFERENCES Users(user_id),
    [password] VARBINARY(8000),
    [changed_at] DATETIME DEFAULT GETDATE()
);


CREATE TABLE [Sessions] (
    [session_id] INT IDENTITY(1,1) PRIMARY KEY,
    [user_id] INT FOREIGN KEY REFERENCES Users(user_id),
    [issued_at] DATETIME DEFAULT GETDATE(),
);